<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";


$id = $_POST['id'];

$insert = $sqli->query("DELETE FROM marcas WHERE id='$id'");

$dados['sucesso'] = 1;
$dados['id_marca'] = $id;
echo json_encode($dados);


?>
