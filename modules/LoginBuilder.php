<?php
    class LoginBuilder extends InnerBuilder {
        function build() {
            $username = $_GET["username"];
            $password = $_GET["p"];
            $accounts = new Accounts();
            if ($accounts->canLogin($username, $password)) {
                session_start();
                echo "{success: true}";
            } else {
                echo "{success: false}";
            }
        }
    }

?>
