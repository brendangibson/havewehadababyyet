<?php        
    class AccessControl {
        static function isUserAllowed ($path) {
            $accounts = new Accounts();
        	return ($accounts->isOwner(Session::getUsername(), $path));
        }
    }
        
?>
