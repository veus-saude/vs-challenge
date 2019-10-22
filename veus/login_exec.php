<?php
session_start();
	include "conect.php";
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$select  = mysqli_query($conect, "select * from login where upper(ds_login) = upper('".$login."') and upper(ds_senha) = upper('".$senha."')") or die(mysqli_error($conect));
	
	if(mysqli_num_rows($select)>0){
		while($resposta = mysqli_fetch_assoc($select)){
			$id_user = $resposta['id_login'];
			$nm_user = $resposta['nm_nome'];
			
			$_SESSION['id_user'] = $id_user;
			$_SESSION['nm_user'] = $nm_user;
			
			echo "search_prod.php";
		}
	}else{
		
		echo "usuário não encontrado, favor tente novamente";
	}

?>