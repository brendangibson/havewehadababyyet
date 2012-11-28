<?php
    class AdminBuilder extends InnerBuilder {

        function build() {
            include('modules/accesscontrol.php');
            include('tpl/admin.php');
        }

    }
?>
