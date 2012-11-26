<?php
    class CreateAccountBuilder extends InnerBuilder {

        function build() {
            $username = $_GET["username"];
            $path = $_GET["path"];
            $password = $_GET["p"];
            
            $account = new Account;
            $account->create($path, $username, $password);
            if ($account->store()) {
                echo '{"success": true}'; 
            } else {
                echo '{"success": false}';
            }
        }

        function isPage() {
            return false;
        }
    }
?>
