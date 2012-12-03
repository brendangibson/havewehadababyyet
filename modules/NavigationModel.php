<?php
    class NavigationModel {
    
        private $loggedIn;
        
        function isLoggedIn () {
            return loggedIn();
        }
        
        function setLoggedIn ($loggedIn) {
            $this->loggedIn = $loggedIn;
        }
        
    }

?>