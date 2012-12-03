<?php
    class LogoutBuilder extends InnerBuilder {
        function build() {
            Session::logout();
            error_log("logged out session id: ".session_id());
            echo '{"success": true}';
        }
        
    	function isPage() { return false; }

    }
?>