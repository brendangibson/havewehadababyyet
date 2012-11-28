<?php

class Request {

    private $path;

    function __construct() {
        error_log("path: " . print_r($_SERVER["ORIG_PATH_INFO"], TRUE));
        $this->path = explode("/", $_SERVER["ORIG_PATH_INFO"]);    
    }

	function isPageRequest() {
		return true;
    }	

    function getPageName() {
        error_log("path: " . print_r($this->path, TRUE));
        return $this->path[1];
    }

    function getPageAddendum() {
        return $this->path[2];
    }
};

?>
