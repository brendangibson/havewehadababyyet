<?php
class StatusBuilder extends InnerBuilder {
   
    private $account;
 
    function __construct($account) {
        $this->account = $account;
    }
    
    function getEmbedded() {
        return $_GET['e'] && $_GET['w'];        
    }

    function build() {
        global $ini_array;
        $account = $this->account;
        error_log("account: " . print_r($account, TRUE));
		ob_start();
        if ($this->getEmbedded()) {
            include("tpl/embeddedStatus.php");
        } else {
		    include("tpl/status.php");
        }
		$returnVal = ob_get_contents();
		ob_end_clean();
		error_log("return: ".$returnVal);
		return $returnVal;
    }
	
	function getIncludeFile() {
		return "tpl/status.php";	
	}
    


}
?>
