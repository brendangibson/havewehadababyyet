<?php

class Account extends DataDriven {

    private $path;
    private $born;
    private $username;
    private $password;
    
    function __construct() {
        parent::__construct();
    }

    function withPath($path) {
        $accountResult = $this->getDataProvider()->getAccount($path);
        $this->born = $accountResult["born"];
        error_log("account in const: ".print_r($accountResult,TRUE));
        return $this; 
    }

    function getBorn() {
        return $this->born ? "yes" : "no";
    }

    function create($path, $username, $password) {
        $this->path = $path;
        $this->username = $username;
        $this->password = $password;
    }

    function store() {
        error_log("Storing: ".print_r($this, TRUE));
        return $this->getDataProvider()->createAccount($this->path, $this->username, $this->password);
    }
}
?>
