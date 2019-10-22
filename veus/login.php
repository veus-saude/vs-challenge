<?php
	session_start();
	session_destroy();
?>

<!Doctype>
<html>
	<head>
		<title>Veus Challenge</title>
		<link rel="stylesheet" href="css/login.css">
		<script type='text/javascript' src='js/biblioteca-jquery.js'></script>
		<script type='text/javascript' src='js/login.js'></script>
	</head>
	
	
	<body>
		<div >
			<form method='POST'>
			
						<h1>Software de Assistência Clínica e Laboratorial</h1>
				<input type='Text' name='login' placeholder='Login'><br>
				<input type='password' name='pass' placeholder='senha'><br>
			</form>
			<button>Entrar</button>
		</div>
	</body>
</html>