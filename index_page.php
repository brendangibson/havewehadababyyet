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
        "createaccount" => "CreateAccountBuilder",
		"loginpage" => "LoginPageBuilder",
        "signup" => "SignupBuilder",
        "help" => "HelpBuilder",
        "admin" => "AdminBuilder",
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

function populate($pageName, $builderInstance, $request) {
    if ( $builderInstance) {
        return $builderInstance->build();
    } else {
        $accounts = new Accounts();
        if ($accounts->isValid($pageName)) {
            $account = $accounts->getAccount($pageName);
            $statusBuilder = new StatusBuilder($account);
            return $statusBuilder->build(); 
        } else {
			return "unknown";
        }
    }
     

}

$pageName = $request->getPageName();
$builderInstance = getBuilder($pageName);
$inner = populate($pageName, $builderInstance, $request);
if ($builderInstance && $builderInstance->isPage()) {
    include('tpl/chrome.php');  
} else {
    echo($inner);
}


?>
