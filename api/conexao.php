<?php

$server = "localhost";
$user = "veustecc_banco";
$pass = "pbnfn9i8"; 
$db   = "veustecc_banco"; 

$sqli = new mysqli($server, $user, $pass, $db);

$sqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

?>
