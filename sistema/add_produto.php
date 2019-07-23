<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";


$id_marca = $_POST['id_marca'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$qtd = $_POST['qtd'];

$insert = $sqli->query("INSERT into produtos (id, id_marca, nome, preco, qtd) VALUES ('', '$id_marca', '$nome', '$preco', '$qtd')");

$dados['sucesso'] = 1;
echo json_encode($dados);


?>
