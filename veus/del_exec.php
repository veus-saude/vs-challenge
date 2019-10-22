<?php
	include "conect.php";
	
	$id = $_POST['id'];
	
	$delete= mysqli_query($conect, "delete from produto where id_prod = '".$id."'") or die(mysqli_error($conect));
	
	echo "Dados excluídos com sucesso!";

?>