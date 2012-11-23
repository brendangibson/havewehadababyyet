<?php

require('modules/Request.php');

function __autoload($class_name) {
    error_log("including $class_name");
    include "modules/" .$class_name . '.php';
}

$request = new Request();



function populate($pageName) {

    $pages = array(
        "signup" => "SignupBuilder",
        "help" => "HelpBuilder",
        "admin" => "AdminBuilder",
        "" => "HomeBuilder"
    );
    error_log("page name: ". $pageName);
    $builder = $pages[$pageName];
    error_log("builder: " . $builder);
    error_log("pages: " . print_r($pages, TRUE));
    if ( $builder) {
        $reflectedBuilder = new ReflectionClass($builder);
        $builderInstance = $reflectedBuilder->newInstance();
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

if ($request->isPageRequest()) {
    $inner = populate($request->getPageName());
	include('tpl/chrome.php');	
} else {
	echo "not a page";
}


?>
