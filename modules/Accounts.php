<?php

require("modules/Account.php");

class Accounts {
    
    function __construct() {
    }

    function isValid($accountPath) {
        return true;
    }

    function getAccount($accountPath) {
        return new Account();
    }
}
?>
