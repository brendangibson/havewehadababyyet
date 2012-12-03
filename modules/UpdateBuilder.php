<?php

    class UpdateBuilder extends InnerBuilder {
    
        function build () {
            $path = $_GET['path'];
            if ($path && AccessControl::isUserAllowed($path)) {
                $hasChanges = false;
                $account = new Account();
                $account->withPath($path);
                if ($_GET['born']) {
                    $account->setBorn(true);
                    $hasChanges = true;
                }
                if ($hasChanges && $account->store()) {
                    echo '{"success" : true}';
                    return;
                }
            }
            echo '{"success" : false}';
        }

        function isPage () {
            return false;
        }

    }
?>