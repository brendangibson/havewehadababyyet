<?php
class StatusBuilder extends InnerBuilder {
   
    private $account;
 
    function __construct($account) {
        $this->account = $account;
    }

    function build() {
        $account = $this->account;
        error_log("account: " . print_r($account, TRUE));
        include("tpl/status.php");
    }

}
?>
