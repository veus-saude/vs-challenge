<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'vs_challenge';
    private $username = 'root';
    private $password = '19921258';
    private $conn;

    public function connect() {
        $this->conn = null;
        try 
        {
            $this->conn = new PDO("sqlite:../db/db.sqlite");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}