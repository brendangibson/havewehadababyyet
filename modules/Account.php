<?php

class Account {

    private $statusString = "No";

    function __construct() {
    }

    function getStatus() {
        return $this->statusString;
    }
}
?>
