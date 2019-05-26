<?php

$campos = $_POST;
$server = $_SERVER['SERVER_NAME'];
$script = $_SERVER['SCRIPT_NAME'];

/* Monta arquivo de conexão ao banco de dados */
$databaseFile = '<?php
namespace app\config;

class database {

    private $host = "' . trim($campos['host']) . '";
    private $usuario = "' . trim($campos['usuario']) . '";
    private $senha = "' . trim($campos['senha']) . '";
    private $db = "' . trim($campos['schema']) . '";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->usuario, $this->senha);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

}';

$newDatabaseFile = fopen("api/app/config/database.php", "w");
fwrite($newDatabaseFile, $databaseFile);
fclose($newDatabaseFile);

rename('index.php', '_setup_index.php');
rename('_index.php', 'index.php');

$folder = str_replace('/config.php', '', $script);

$createTable = 'http://' . $server . $folder . '/api/v1/createtable';

file_get_contents($createTable);

?>