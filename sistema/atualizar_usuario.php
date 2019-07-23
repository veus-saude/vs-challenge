<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança  
protegePagina(); // Chama a função que protege a página 

include "conexao.php";

$id = $_POST['id'];
$nome2 = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

 $_UP['extensoes'] = array('pdf', 'PDF', 'doc', 'DOC', 'jpg', 'JPG', 'png', 'PNG', 'bmp', 'BMP', 'gif', 'GIF', 'JPEG', 'jpeg');
 $pasta = 'fotos/';


 $tmp_name = $_FILES["arquivo"]["tmp_name"];
 $temp = substr(md5(uniqid(time())), 0, 10);
 $titulo = $_FILES["arquivo"]["name"];
 $extensao = strtolower(end(explode('.',$_FILES["arquivo"]["name"])));
 $cod = $pasta . date('dmy') . '-' . $temp . '.' . $extensao;
 $nome = $_FILES["arquivo"]["name"];
 $uploadfile = $pasta . basename($cod);
 if (array_search($extensao, $_UP['extensoes']) === false) {
	$foto = $_POST['arquivo_antigo'];
 } 
 else {
 move_uploaded_file($tmp_name, $uploadfile);

	$foto = $uploadfile;
 }

$insert = $sqli->query("UPDATE usuarios SET nome='$nome2', usuario='$usuario', senha='$senha', foto='$foto' WHERE id='$id'");


$dados['sucesso'] = 1;
$dados['id_usuario'] = $id;
echo json_encode($dados);


?>
