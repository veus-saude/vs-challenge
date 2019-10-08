<?php
class Auth {
    private $conn;
    private $table = 'users';
    public $user_id;
    public $user_name;
    public $user_password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE user_name=? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_name);
    
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($row) > 0 && $this->user_password == $row[0]['password']) {
            $this->user_id = $row[0]['user_id'];
            return true;
        }
        else {
            return false;
        }
    }
}