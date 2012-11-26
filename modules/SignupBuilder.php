<?php
class SignupBuilder extends InnerBuilder {
   
    function __construct() {
    }

    function build() {
        include("tpl/signup.php");
    }
}
?>
