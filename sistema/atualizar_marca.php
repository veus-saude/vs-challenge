<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";

$id = $_POST['id'];
$marca = $_POST['marca'];

$insert = $sqli->query("UPDATE marcas SET marca='$marca' WHERE id='$id'");


$dados['sucesso'] = 1;
$dados['id_marca'] = $id;
echo json_encode($dados);


?>
