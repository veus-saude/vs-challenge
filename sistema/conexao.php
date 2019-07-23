<?php
session_start();

$server = ""; // Servidor MySQL
$user = ""; // Usuário MySQL
$pass = "";   // Senha MySQL
$db   = "";  // Banco de dados MySQL

$sqli = new mysqli($server, $user, $pass, $db);

$sqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

?>
