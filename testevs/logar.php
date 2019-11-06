<?php
//BUSCANDO AS CLASSES
require_once 'classes/Login.class.php';
//ESTANCIANDO A CLASSES
$objLog = new Login();

//FAZENDO O LOGIN
if(isset($_POST['btLogar'])){
    $objLog->userLogar($_POST);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Teste VS</title>
    <!-- ESTILOS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
</head>
<body>

<div class="container">
  
  <div class="container-fluid bg-branco">
    <div class="row text-center" style="padding-top:80px;">
      <div class="col-lg-12 text-center"><h1>SLAM Comércio S/A</h1></div>
    </div>
  </div>
  
  <div class="container-fluid">
    <div class="row" style="padding-top:80px;">
      <div class="col-lg-6 offset-lg-3">
        <h2 class="text-center">Login</h2><br>
        <form action="" method="post">
          <div class="form-group">
            <label for="login">Usuário:</label>
            <input type="text" class="form-control" id="login" name="login">
          </div>
          <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" class="form-control" id="pwd" name="pswd">
          </div>
          <button type="submit" name="btLogar" class="form-control btn btn-secondary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>