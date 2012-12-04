<?php


class MySQLDataProvider extends DataProvider {

    private $db;
    private $insertId;
    
    private static $ROUNDS = 10;

    function __construct() {
        if (!$this->db) {
            include("../../havewehadababyyet/db.php");
            $this->db = new mysqli($host, $user, $p, $database);
            if ($this->db->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            }
        }
    }

    private function query ($queryStr) {
        error_log("query: $queryStr");
        $result =  $this->db->query($queryStr);
        if (!$result) {
            error_log("Query error: ".$this->db->error);
        } else {
            $this->insertId = $this->db->insert_id;
            error_log("insert id: ".$this->insertId);
        }
        
        //$this->db->close();
        return $result;
    }
    
    public function escape ($str) {
        return $this->getHandle()->real_escape_string($str);
    }

    private function getInsertId () {
        return $this->insertId;
    }

    function getHandle () {
        return $this->db;
    }

    function getAccountNames () {
        return  $this->query("SELECT path FROM account");
    }

    function isValid ($path) {
        $path = $this->escape($path);

        $result = $this->query("SELECT EXISTS (SELECT 1 FROM Birth WHERE path = '$path')");
        $row = $result->fetch_row();
        return $row[0];
    }

    function getAccount ($path) {
        $path = $this->escape($path);

        $result = $this->query("SELECT * FROM Birth WHERE path = '$path'");
        $row = $result->fetch_assoc();
        return $row;
    }

    static function encryptPassword($password) {
        $bcrypt = new Bcrypt(self::$ROUNDS);

        $hash = $bcrypt->hash($password);
        return $hash;
    }
    
    static function verifyPassword($password, $hash) {
        $bcrypt = new Bcrypt(self::$ROUNDS);
        return $bcrypt->verify($password, $hash);
    }

    function createAccount($path, $username, $password) {
        $path = $this->escape($path);
        $username = $this->escape($username);
        $password = $this->escape($password);
        $encryptedPassword = self::encryptPassword($password);
        
        error_log("ep: $encryptedPassword");

        $result = $this->query("INSERT INTO Birth (path) VALUES ('$path')");
        if ($result) {
            $birthId = $this->getInsertId(); 
            $result2 = $this->query("INSERT INTO Account(username, password) VALUES ('$username', '$encryptedPassword')");
            if ($result2) {
                $accountId = $this->getInsertId();
                $result3 = $this->query("INSERT INTO AccountBirth(account_id, birth_id) VALUES ('$accountId', '$birthId')");
                if ($result3) { 
                    return true; 
                }
            }
        }
        return false;
    }
    
    function getLogin($username, $password) {
        $username = $this->escape($username);
        $password = $this->escape($password);
        
        $encryptedPassword = self::encryptPassword($password);
        $result = $this->query("SELECT path, is_owner, a.password FROM Account a, AccountBirth ab, Birth b 
            WHERE a.username = '$username' AND a.account_id = ab.account_id
                AND b.birth_id = ab.birth_id");
        $row = $result->fetch_assoc();
        error_log("login row: ".print_r($row, TRUE));
        if ($row && $row['is_owner'] && self::verifyPassword($password, $row['password'])) {
            return $row;
        } else {
            return null;
        }
    }
	
	function isOwner($username, $path) {
        $path = $this->escape($path);
        $username = $this->escape($username);
        
		$result = $this->query("SELECT ab.is_owner FROM Account a, AccountBirth ab, Birth b 
			WHERE b.path = '$path' AND a.username = '$username' AND b.birth_id = ab.birth_id AND a.account_id = ab.account_id");
		$row = $result->fetch_row();
		return $row[0];
	}
    
    function updateAccount($path, $born) {
        $path = $this->escape($path);
        $born = $this->escape($born);
    
        $result = $this->query("UPDATE Birth SET born=$born WHERE path='$path'");
        return $result;
    }
}
?>
