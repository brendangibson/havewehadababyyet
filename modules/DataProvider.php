<?php

abstract class DataProvider {

    abstract function getHandle();

    abstract function getAccountNames(); 

    abstract function isValid($accountName); 

    abstract function getAccount($accountName); 
}
?>
