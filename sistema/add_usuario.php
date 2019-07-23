<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";


$nome2 = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$token = substr(md5(uniqid(time())), 0, 16);

 $_UP['extensoes'] = array('pdf', 'PDF', 'doc', 'DOC', 'jpg', 'JPG', 'png', 'PNG', 'bmp', 'BMP', 'gif', 'GIF', 'JPEG', 'jpeg');
 $pasta = 'fotos/';


 $tmp_name = $_FILES["arquivo"]["tmp_name"];
 $temp = substr(md5(uniqid(time())), 0, 10);
 $titulo = $_FILES["arquivo"]["name"];
 $extensao = strtolower(end(explode('.',$_FILES["arquivo"]["name"])));
 $cod = $pasta . date('dmy') . '-' . $temp . '.' . $extensao;
 $nome = $_FILES["arquivo"]["name"];
 $uploadfile = $pasta . basename($cod);
 if ($tmp_name != '') {
 if (array_search($extensao, $_UP['extensoes']) === false) {
	$foto = "";
 } 
 else {
 move_uploaded_file($tmp_name, $uploadfile);

	$foto = $uploadfile;
 }
 }


$insert = $sqli->query("INSERT into usuarios (id, nome, usuario, senha, token, foto) VALUES ('', '$nome2', '$usuario', '$senha', '$token', '$foto')");

$dados['sucesso'] = 1;
echo json_encode($dados);


?>
