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

$resultadosporpagina = 1;
$sql = "SELECT * FROM vs";
$results_query = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($results_query);



$number_of_pages = ceil($number_of_results/$resultadosporpagina);

if(!isset($_GET['page']))
{
  $page = 1;
} else
{
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$resultadosporpagina;

$sql = "SELECT * FROM vs LIMIT " . $this_page_first_result . ',' . $resultadosporpagina;
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result))
{
  echo "<center>Produtos: </center>";
  echo $row['marca'] . ' ' . $row['nome'] . '<br>';
}
for ($page=1;$page<=$number_of_pages;$page++)
{
  echo '<a href="Pagining.php?page=' . $page . '">' . $page . '</a>';
}
?>
</body>
</html>
