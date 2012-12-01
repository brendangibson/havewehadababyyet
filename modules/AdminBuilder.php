<?php
    class AdminBuilder extends InnerBuilder {
		
		private $username;
		private $path;
        private $account;
		
		function __construct($username, $path) {
			$this->username = $username;
			$this->path = $path;
			
			error_log("adminbuilder: ".print_r($this,TRUE));
		}

        function build() {
			if (AccessControl::isUserAllowed($this->path)) {
                $accounts = new Accounts();
                $this->setAccount($accounts->getAccount($this->path));
            	include('tpl/admin.php');
			} else {
				$loginPageBuilder = new LoginPageBuilder();
				echo $loginPageBuilder->build();	
			}
        }
        
        function getAccount() {
            return $this->account;
        }
        
        function setAccount($account) {
            $this->account = $account;
        }

    }
?>
