<html>
  <head>
    <meta charset="utf-8">
    <title>Desafio PHP VS</title>
  </head>
  <body>
    <p align="center">
    <img src="https://camo.githubusercontent.com/d3e1b9d696e728186fb2d30923e87483272671ae/68747470733a2f2f692e696d6775722e636f6d2f324c55523279792e706e67">
</p>
<?php
$servidor = "localhost";
$usuario = "root";
$senha = "1234";
$dbname = "ProdutosBUNZL";
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

$valid_passwords = array ("Admin" => "Admin");
$valid_users = array_keys($valid_passwords);
$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];
$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="Desafio VS"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Não Autorizado");
}


echo "<p>Bem Vindo $user.</p>";
echo "<p>Parabéns, você está logado!</p>";

?>
<h1>Pesquisar Produto:</h1>

<form name="search_form" method="POST" action="pesquisar.php">
Pesquisar:<input type="text" name="pesquisar" placeholder="Digite o nome do produto"/>
<select name="marca">
<option value="">Marcas </option>
<?php
$result_marca = "SELECT * FROM vs WHERE marca_id";
$resultado_marca = mysqli_query($conn, $result_marca);
while ($rows_marca = mysqli_fetch_array($resultado_marca)) {
     $marca = $rows_marca['marca'];
     $marca_id = $rows_marca['marca'];
   echo "<option value='$marca_id'>$marca</option>";

}

?>
</select>
<input type="submit" value="Pesquisar">
</form>
</body>
</html>
