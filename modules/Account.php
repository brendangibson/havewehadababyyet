<?php

class Account extends DataDriven {

    private $path;
    private $born;
    
    function __construct($path) {
        parent::__construct();
        $accountResult = $this->getDataProvider()->getAccount($path);    
        $this->born = $accountResult["born"];
        error_log("account in const: ".print_r($accountResult,TRUE));
    }

    function getBorn() {
        return $this->born ? "yes" : "no";
    }
}
?>
