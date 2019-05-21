<?php session_start();

$_SESSION = array();
require_once('classes/banco.class.php');

$Conexao = new Conexao();
$conn = $Conexao->conecta();

$login = $_POST['login'];
$senha = md5($_POST['senha']);


$sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();


$_SESSION['s_id_usuario'] = $row['idusuario'];
$_SESSION['s_login'] = $row['login'];
$_SESSION['s_nome_usuario'] = $row['nome'];


if (!empty($_SESSION['s_id_usuario'])) {
	header("Location:aplicacao/index.php"); 
}else{
	session_destroy();
  header('Location:index.php?erro=2');
}

?>