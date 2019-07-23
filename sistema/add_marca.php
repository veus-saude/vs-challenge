<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";


$marca = $_POST['marca'];

$insert = $sqli->query("INSERT into marcas (id, marca) VALUES ('', '$marca')");

$dados['sucesso'] = 1;
echo json_encode($dados);


?>
