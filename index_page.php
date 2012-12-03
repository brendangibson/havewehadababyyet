<?php

require('modules/Request.php');

function __autoload($class_name) {
    error_log("including $class_name");
    include "modules/" .$class_name . '.php';
}

$request = new Request();

function getPages() {

    return array(
        "about" => "AboutBuilder",
        "admin" => "AdminBuilder",
        "createaccount" => "CreateAccountBuilder",
        "help" => "HelpBuilder",
        "login" => "LoginBuilder",
		"loginpage" => "LoginPageBuilder",
        "logout" => "LogoutBuilder",
        "signup" => "SignupBuilder",
        "update" => "UpdateBuilder",
        "" => "HomeBuilder"
    );
}

function getBuilder($pageName) {

    $pages = getPages();
    error_log("page name: ". $pageName);
    $builder = $pages[$pageName];
    error_log("builder: " . $builder);
    error_log("pages: " . print_r($pages, TRUE));
    if ( $builder) {
        $reflectedBuilder = new ReflectionClass($builder);
        $builderInstance = $reflectedBuilder->newInstance();
        return $builderInstance;
    } else {
        return null;
    }
}

session_start();
$ini_array = parse_ini_file("config.ini");
$pageName = $request->getPageName();
$builderInstance = getBuilder($pageName);
$path = '';
$statusPage = false;

if ( !$builderInstance) {
		
	error_log("no builder");
	$accounts = new Accounts();
	error_log("accounts: ".print_r($accounts,TRUE));
	if ($accounts->isValid($pageName)) {
        $path = $pageName;
        
		if ($request->getPageAddendum() == "admin") {
			$username = Session::getUsername();
			error_log("before admin: ".print_r($_SESSION,TRUE));
			$builderInstance = new AdminBuilder($username,$pageName);
		} else {
			$account = $accounts->getAccount($pageName);
			$builderInstance = new StatusBuilder($account);
            $statusPage = true;
		}
	} else {
		$builderInstance = new UnknownBuilder();
	}
}


if ($request->isNonPageRequest() || ($builderInstance && !$builderInstance->isPage())) {
    include('modules/populateInner.php');
} else {
    include('tpl/chrome.php');  
}


?>
