<?php

require("../../havewehadababyyet/db.php");

class AccountsDataProvider {

    private $db;

    function __construct() {
        if (!$this->db) {
            $this->db = new mysqli($host, $user, $p, $database);
            if ($this->db->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            }
        }
        echo $this->db->host_info . "\n";
    }

    function getHandle() {
        return $db;
    }

    function getAccountNames() {
        return  $this->db->query("SELECT path FROM account");
    }

    function getAccount($accountName) {
        return  $this->db->query("SELECT 1 FROM account WHERE path = " . $accountName);
    }
}
?>
