<?php
include '../sistema/conexao.php';

if(isset($_GET['token'])){

$sql_user = $sqli->query("SELECT id FROM usuarios WHERE token='".$_GET['token']."'");
$row_user = $sql_user->fetch_assoc();

if(!$row_user['id']) {
$dados['erro'] = "Token Invalido.";
echo json_encode($dados);
}
if($row_user['id']) {

if($_GET['q']) { $b1 = "AND nome LIKE '%".$_GET['q']."%'"; } else { $b1 = ""; }
if($_GET['brand']) { $b2 = "AND id_marca='".$_GET['brand']."'"; } else { $b2 = ""; }
if($_GET['sort']) { $sort = "ORDER BY ".$_GET['sort']; } else { $sort = "ORDER BY nome"; }
if($_GET['pg'] != '' and $_GET['limit'] != '') {
if(is_numeric($_GET['pg']) AND is_numeric($_GET['limit'])) {
if($_GET['pg'] <= 1) { $offset = ""; }
if($_GET['pg'] > 1) { $offset = " OFFSET ".($_GET['pg']-1) * $_GET['limit']; }
else { $offset = ""; }
$pages = "LIMIT ".$_GET['limit'].$offset;
}
else {
$pages = "LIMIT 10";
}
}
else {
$pages = "LIMIT 10";
}



$sql_consult = $sqli->query("SELECT * FROM produtos WHERE id!='' $b1 $b2 $sort $pages");
$n_consult = $sql_consult->num_rows;
while($row_consult = $sql_consult->fetch_assoc()) {
$dados[] = array_map('utf8_encode', $row_consult);
}

if($n_consult > 0) {
echo json_encode($dados);
}
else {
$dados['erro'] = "Sem Produtos encontrados.";
echo json_encode($dados);
}
}
}
else {
$dados['erro'] = "Token Nao informado.";
echo json_encode($dados);
}
?>
