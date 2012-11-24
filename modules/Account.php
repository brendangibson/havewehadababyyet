<?php

class Account extends DataDriven {

    private $path;
    private $status;
    
    function __construct($path) {
        parent::__construct();
        $accountResult = $this->getDataProvider()->getAccount($path);    
        $this->status = $accountResult[2];
        error_log("account in const: ".print_r($accountResult,TRUE));
    }

    function getStatus() {
        return $this->status ? "yes" : "no";
    }
}
?>
