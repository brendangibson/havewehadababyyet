<?php

class Request {

    private $path;

    function __construct() {
        $originalPath = isset($_SERVER["ORIG_PATH_INFO"]) ? $_SERVER["ORIG_PATH_INFO"] : null;
        error_log("path: " . print_r($originalPath, TRUE));
        $this->path = explode("/", $originalPath);    
    }

	function isNonPageRequest() {
		return isset($_GET['np']) && $_GET['np'];
    }	

    function getPageName() {
        error_log("path: " . print_r($this->path, TRUE));
        return isset($this->path[1]) ? $this->path[1] : null;
    }

    function getPageAddendum() {
        return isset($this->path[2]) ? $this->path[2] : null;
    }
};

?>
