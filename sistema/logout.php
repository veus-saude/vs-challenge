<?php

session_start(); //iniciamos a sessão que foi aberta
include "conexao.php";


session_destroy(); //pei!!! destruimos a sessão ;)
session_unset(); //limpamos as variaveis globais das sessões

echo "<script> window.location.href='login.php'; </script>"; 

?>