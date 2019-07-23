<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";

$id = $_POST['id'];
$id_marca = $_POST['id_marca'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$qtd = $_POST['qtd'];

$insert = $sqli->query("UPDATE produtos SET id_marca='$id_marca', nome='$nome', preco='$preco', qtd='$qtd' WHERE id='$id'");


$dados['sucesso'] = 1;
$dados['id_produto'] = $id;
echo json_encode($dados);


?>
