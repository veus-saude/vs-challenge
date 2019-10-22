<?php
	include "conect.php";
	
	
	
	$id = isset($_POST['id'])?$_POST['id']:'';
	$nm_prod = isset($_POST['nm_prod'])?$_POST['nm_prod']:'';
	$ds_marca = isset($_POST['ds_marca'])?$_POST['ds_marca']:'';
	$ds_preco = isset($_POST['ds_preco'])?$_POST['ds_preco']:'';
	$qtdest = isset($_POST['qtdest'])?$_POST['qtdest']:'';



	if($id && $nm_prod && $ds_marca && $ds_preco && $qtdest){
		$update = mysqli_query($conect, "update produto set ds_prod = '".$nm_prod."', ds_marca = '".$ds_marca."', vl_preco = '".$ds_preco."', qt_estoque = '".$qtdest."' where id_prod = '".$id."'") or die(mysqli_error($conect)); 
		
		echo "Dados atualizados com sucesso!";
	}else{
		echo "Dados não alterados, favor tente novamente";
	}
?>