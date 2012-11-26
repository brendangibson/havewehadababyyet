<?php


class MySQLDataProvider extends DataProvider {

    private $db;
    private $insertId;

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
        $result =  $this->db->query($queryStr);
        if (!$result) {
            error_log("Insert error: ".$this->db->error);
        } else {
            $this->insertId = $this->db->insert_id;
            error_log("insert id: ".$this->insertId);
        }
        
        //$this->db->close();
        return $result;
    }

    private function getInsertId() {
        return $this->insertId;
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
        $row = $result->fetch_assoc();
        error_log("in dp, account: ".print_r($row,TRUE));
        return $row;
    }

    function createAccount($path, $username, $password) {
        $encryptedPassword = $password;
        $result = $this->query("INSERT INTO Birth (path) VALUES ('$path')");
        if ($result) {
            $birthId = $this->getInsertId(); 
            $result2 = $this->query("INSERT INTO Account(username, password) VALUES ('$username', '$password')");
            if ($result2) {
                $accountId = $this->getInsertId();
                $result3 = $this->query("INSERT INTO AccountBirth(account_id, birth_id) VALUES ('$accountId', '$birthId')");
                if ($result3) { return true; }
            }
        }
        return false;
    }
}
?>
