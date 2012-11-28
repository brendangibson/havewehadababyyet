<?php
class StatusBuilder extends InnerBuilder {
   
    private $account;
 
    function __construct($account) {
        $this->account = $account;
    }

    function build() {
        $account = $this->account;
        error_log("account: " . print_r($account, TRUE));
		ob_start();
		include("tpl/status.php");
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
