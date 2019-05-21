<?php session_start();

session_destroy();

if(isset($_REQUEST['erro']))
{	
	$erro = $_REQUEST['erro']; 

	if($erro == 1){
		$html = "<div class='alert alert-warning alert-dismissible' role='alert'>
				<strong>ERRO!</strong> Login Obrigatório! </div>";
	}
	if($erro == 2){
		$html = "<div class='alert alert-warning alert-dismissible' role='alert'>
				<strong>ERRO!</strong> Usuário ou Senha incorreto! </div>";
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página de Login</title>
	<link rel="icon" type="image/png" href="/img/logoicone.png" />
		
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/login.css" rel="stylesheet">

	
	
	
  </head>
  <body>
  
  
  <div class="wrapper">
  
    <form class="form-signin" method="POST" action="login.php">    
	<div align="center">
     <img src="img/logo.jpg" class="img-responsive" alt="Responsive image">
     </div>
	 <input type="text" class="form-control" name="login" placeholder="Login" required="" autofocus="" />
      <input type="password" class="form-control" name="senha" placeholder="Senha" required=""/>  
	  <?php if(!empty($html)) echo $html;?>	  
		<div id="alert_placeholder"></div>	  
      <label >
       
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>  
	
    </form>
  </div>

  </body>
</html>