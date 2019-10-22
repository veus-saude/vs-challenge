<!Doctype>
<html>
	<head>
		<title>Cadastro de Produtos</title>
		<link rel="stylesheet" href="css/cadprod.css">
		<script type='text/javascript' src='js/biblioteca-jquery.js'></script>
		<script type='text/javascript' src='js/jquery.mask.js'></script>
		<script type='text/javascript' src='js/cadprod.js'></script>
	</head>
	
	
	<body>
		<?php include "head.php"?>
		
		<div id='icon_search'>
			<h3>Buscar Produtos <img src='img/search_icon.png'></h3>
		</div>
		<section id='center'>
			<h1>Cadastro de Produtos</h1>
			
			<form action='grava_prod.php'  method='POST'>
				<label>Nome:</label>
				<input type='text' name='nomeprod' placeholder='Nome do produto' required><br>
				<label>Marca:</label>
				<input type='text' name='marcaprod' placeholder='Marca do produto' required><br>
				<label>Preço:</label>
				<input type='text' name='precoprod' placeholder='99.99' required maxlength='10'><br>
				<label>Quantidade em Estoque:</label>
				<input type='text' name='qtdprod' placeholder='999' required maxlength='10'><br>
			</form>
			
			<button>Gravar</button>
			<button>Limpar</button>
		</section>
	</body>
</html>