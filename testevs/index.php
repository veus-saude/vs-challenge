<?php
//Inicializando classe
require_once "classes/Produto.class.php";

$classe = new Produto();

    //Recebendo termo para busca
    if(isset($_GET['nome']) AND !empty($_GET['marca'])){
        $lista = $classe->busca($_GET['nome'],$_GET['marca']);
    }else{
        $lista = $classe->paginacao((!empty($_GET['pag']))?$_GET['pag']:1);
    }
?>

<!doctype html>
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
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="main-logo-margin" href="">SLAM Comércio S/A</a>
            </div>
            <div>
                <a class="main-logo-margin" href="logar.php">Área Restrita</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row text-center" style="padding-top:80px;">
            <div class="col-lg-12 text-center"><h1>SLAM Comércio S/A</h1></div>
        </div>
    </div>

    <div class="row main-low-margin text-center">
        <div class="text-center col-md-10 offset-1">
            <form action="?nome=nome&marca=marca" method="GET">
                <div class="row">
                    <div class="col-md-3">
                      <input type="text" name="nome" class="form-control" placeholder="Busque pelo nome do produto" required>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="marca" class="form-control" placeholder="Busque pela marca do produto" required>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-primary form-control" value="Pesquisar">
                    </div>
                </div>
            </form>
        </div>
    </div><br>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> <h3 class="panel-title">Lista de Produtos</h3> </div>
            <?= $lista ?>
        </div>
    </div>

</body>
</html>