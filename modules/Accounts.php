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
        return new Account($accountPath);
    }
}
?>
