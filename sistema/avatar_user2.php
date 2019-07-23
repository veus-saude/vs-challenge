<?php
require( 'canvas.php' );
$foto = $_GET['foto'];
list($largura, $altura, $type, $attr) = getimagesize($foto);


if ($largura > $altura) {
$img = new canvas();
$img->carregaUrl( $foto )->hexa( '#ffffff' )->redimensiona( 40, 40, 'crop')->grava();
exit;
}

if ($largura < $altura) {
$img = new canvas();
$img->carregaUrl( $foto )->hexa( '#ffffff' )->redimensiona( 40, 40, 'crop')->grava();
exit;
}

if ($largura == $altura) {
$img = new canvas();
$img->carregaUrl( $foto )->hexa( '#ffffff' )->redimensiona( 40, 40, 'crop')->grava();
exit;
}

?>