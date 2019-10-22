<?php
	session_start();
	include "conect.php";
	
	if(!($_SESSION['id_user'])){
		echo "<script>alert('usuário não encontrado, favor entre novamente!')</script>";
		
		
		echo "<script>window.location.replace('login.php')</script>";
		
	}
?>

<!doctype>
<html>
	<head>
		<title>Pesquisa de Produtos</title>
		<link rel="stylesheet" href="css/search_prod.css">
		<script type='text/javascript' src='js/biblioteca-jquery.js'></script>
		<script type='text/javascript' src='js/jquery.mask.js'></script>
		<script type='text/javascript' src='js/search_prod.js'></script>
	</head>
	
	<body>
			<?php include "head.php"?>
		<section>
				
				<div id='search'>
				
					<img src='img/search_icon.png' class='search_icon'>
					<input name='search' placeholder='pesquisa'> 
					<label>Marca</label>
						<select>
							<option value='nda'>
								Selecione uma opção
							</option>
						<?php
							$select = mysqli_query($conect, "select distinct ds_marca from produto") or die(mysqli_error($conect));
							
							while($resposta = mysqli_fetch_assoc($select)){
								echo "<option value='".$resposta['ds_marca']."'>".$resposta['ds_marca']."</option>";
							}
						?>
						</select>
						<img src='img/addprod.png' class='addprod'>
						
				</div>
				
			<table class='top'>
				<tr>
					<td class='tdnome'>Nome</td>
					<td class='tdmarca'>Marca</td>
					<td class='tdpreco'>Preço</td>
					<td class='tdqtest'>Quantidade em Estoque</td>
					<td class='tdedit'>Editar</td>
					<td class='tddelete'>Excluir</td>
				</tr>
			</table>			
			
					<div id='lista_prod'>

					</div>
							
							<table id='pagination'>
								<tr>			
								</tr>
							</table>
			
		</section>
	</body>
</html>