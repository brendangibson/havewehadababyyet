<?php
    class LoginBuilder extends InnerBuilder {
        function build() {
            $username = $_GET["username"];
            $password = $_GET["p"];
            $accounts = new Accounts();
            $account = $accounts->getLogin($username, $password);
            error_log("login: ".print_r($account,TRUE));
            if ($account) {
                Session::startSession($account['path'], $username); 
                echo '{"success": true, "path": "'.$account['path'].'" }';
            } else {
                echo '{"success": false}';
            }
        }
		
		function isPage() { return false; }

    }



?>
