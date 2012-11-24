<?php

require("modules/DataProviderFactory.php");

class DataDriven {

    private $dataProvider;
    
    function __construct() {
        $this->dataProvider = DataProviderFactory::get();
    }

    function getDataProvider() {
        return $this->dataProvider;
    }

}
?>
