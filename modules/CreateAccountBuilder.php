<?php
    class CreateAccountBuilder extends InnerBuilder {

        function build() {
            $username = $_GET["username"];
            $path = $_GET["path"];
            $password = $_GET["p"];
            
            $account = new Account;
            $account->create($path, $username, $password);
            if ($account->storeNew()) {
                Session::startSession($path, $username);
                echo '{"success": true}'; 
            } else {
                $_SESSION = array(); 
                session_destroy();
                echo '{"success": false}';
            }
        }

        function isPage() {
            return false;
        }
    }
?>
