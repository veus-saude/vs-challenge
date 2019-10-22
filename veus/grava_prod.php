<?php
	session_start();
	
	include 'conect.php';
	
	$nomeprod = $_POST['nomeprod'];
	$marcaprod = $_POST['marcaprod'];
	$precoprod = $_POST['precoprod'];
	$qtdprod = $_POST['qtdprod'];
	
	$insert = mysqli_query($conect, "INSERT INTO `produto`(`id_prod`, `ds_prod`, `ds_marca`, `vl_preco`, `qt_estoque`) VALUES
										(null,'".$nomeprod."','".$marcaprod."','".$precoprod."','".$qtdprod."' )") or die(mysqli_error($conect));


	header('location:cadastro_prod.php');
	
?>