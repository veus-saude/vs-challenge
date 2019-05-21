<?php 

$id =  $_SESSION['s_id_usuario'];

$nome_usuario = $_SESSION['s_nome_usuario'];

if (empty($id) && empty($nome_usuario)) {

  header("Location: ../index.php?erro=1");
}


?>
