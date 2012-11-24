<?php

require "modules/MySQLDataProvider.php";

class DataProviderFactory {
    public static function get() {
        return new MySQLDataProvider();
    }
}

?>
