<?php


class MySQLDataProvider extends DataProvider {

    private $db;

    function __construct() {
        if (!$this->db) {
            include("../../havewehadababyyet/db.php");
            error_log("Details: $user $p $host $database");
            $this->db = new mysqli($host, $user, $p, $database);
            if ($this->db->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            }
        }
    }

    private function query($queryStr) {
        error_log("query: $queryStr");
        return $this->db->query($queryStr);
    }

    function getHandle() {
        return $db;
    }

    function getAccountNames() {
        return  $this->query("SELECT path FROM account");
    }

    function isValid($path) {
        $result = $this->query("SELECT EXISTS (SELECT 1 FROM Birth WHERE path = '$path')");
        $row = $result->fetch_row();
        return $row[0];
    }

    function getAccount($path) {
        $result = $this->query("SELECT * FROM Birth WHERE path = '$path'");
        $row = $result->fetch_row();
        error_log("in dp, account: ".print_r($row,TRUE));
        return $row;
    }
}
?>
