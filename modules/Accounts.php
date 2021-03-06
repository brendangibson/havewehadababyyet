<?php

require("modules/Account.php");

class Accounts extends DataDriven {

    
    function __construct() {
       parent::__construct();
    }

    function isValid($accountPath) {
        error_log("Checking whether $accountPath is valid");
        return $this->getDataProvider()->isValid($accountPath);
    }

    function getAccount($accountPath) {
        $account = new Account();
        return $account->withPath($accountPath);
    }

    function canLogin($username, $password) {
        return true;
    }
    
    function getLogin($username, $password) {
        return $this->getDataProvider()->getLogin($username, $password);
    }
	
	function isOwner($username, $path) {
		return $this->getDataProvider()->isOwner($username, $path);	
	}
}
?>
