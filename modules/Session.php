<?php

    class Session {
        
        static function startSession($path = null, $username = null) {
			error_log("starting with path: $path, username: $username");
			if ($path) {
                $_SESSION['path'] = $path;
            }
			if ($username) {
				$_SESSION['username'] = $username;	
			}
			
			error_log("session: ".print_r($_SESSION, TRUE));
            error_log("started session with session id: ".session_id());
        }
        
        static function getPath() {
            return $_SESSION['path'];
        }
        
        static function isLoggedIn() {
            error_log("checking session id: ".session_id());
            return session_id() != null && $_SESSION['path'];
        }
        
        static function logout() {
            error_log("logging out");
            session_destroy();
        }
		
		static function getUsername() {
			return $_SESSION['username'];	
		}

    
    }
?>