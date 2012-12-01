<?php

class Account extends DataDriven {

    private $path;
    private $born;
    private $username;
    private $password;
    
    function __construct () {
        parent::__construct();
    }

    function withPath ($path) {
        $this->path = $path;
        $accountResult = $this->getDataProvider()->getAccount($path);
        $this->born = $accountResult["born"];
        error_log("account in const: ".print_r($accountResult,TRUE));
        return $this; 
    }

    function getBorn () {
        return $this->born ? "yes" : "no";
    }
    
    function isBorn () {
        return $this->born;
    }

    function setBorn ($born) {
        $this->born = $born;
    }
    
    function setPath ($path) {
        $this->path = $path;
    }
    
    function getPath () {
        return $this->path;
    }
    
    function create ($path, $username, $password) {
        $this->path = $path;
        $this->username = $username;
        $this->password = $password;
    }

    function storeNew () {
        error_log("Storing: ".print_r($this, TRUE));
        return $this->getDataProvider()->createAccount($this->path, $this->username, $this->password);
    }
    
    function store () {
        return $this->getDataProvider()->updateAccount($this->path, $this->born);
    }
}
?>
