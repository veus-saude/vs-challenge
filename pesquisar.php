
<html>
<head>
  <title>Resultados</title>
</head>
<body>
<?php
$servidor = "localhost";
$usuario = "root";
$senha = "1234";
$dbname = "ProdutosBUNZL";

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
$pesquisar = $_POST['pesquisar'];
$marca = $_POST['marca'];
$resultado_filtro = "SELECT * FROM vs WHERE marca = '$marca' and nome LIKE '%".$pesquisar."%'";
$resultadoquery = mysqli_query($conn, $resultado_filtro);
$row = mysqli_num_rows($resultadoquery);

if($marca == null)
{
  echo "<center>Por favor selecione uma Marca.</center>";
  echo "<br/>";
  echo "<a href='site.php'>Voltar</a>";
  exit();
}
if($pesquisar == null)
{
  echo "<center>Por favor digite um produto.</center>";
  echo "<br/>";
  echo "<a href='site.php'>Voltar</a>";
  exit();
}
if($row > 0)
{
  while($resultadosfiltroline = mysqli_fetch_array($resultadoquery))
  {
    $resultado_filtro = $resultadosfiltroline['nome'] ;
    echo "<strong>Resultados da Pesquisa: </strong>$resultado_filtro"."<br>";
    echo "<strong>Marca: </strong><option value='$marca'>$marca</option>";

  }
}else{
echo "<center> Nenhum resultado encontrado</center>";
}

 ?>
</body>
 </html>
