<?php
//Inicializando classe
require_once "../classes/Produto.class.php";

$classe = new Produto();

if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'delet':
            if($classe->queryDelete($_GET['idus']) == 'ok'){
            header('location: index.php');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
        break;
    }        
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
    <link rel="stylesheet" type="text/css" href="../css/estilos.css"/>   
</head>

<body>
    <div class="container-fluid">
        <div class="row text-center" style="padding-top:80px;">
            <div class="col-lg-12 text-center"><h1>SLAM Comércio S/A</h1></div>
        </div>
    </div>

    <div class="container" style="margin-top: 100px;">
        <div class="panel panel-primary">
            <div class="panel-heading"> <h3 class="panel-title">Lista de Produtos</h3> </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="18%"><a class="btn btn-success" href="/testevs/produto/viewPage.php">+ Adicionar Produto</a></th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($classe->querySelect() as $rst){ ?>
                        <tr>
                            <td>
                                <a class="btn btn-warning" href="/testevs/produto/viewPage.php?edit=ok&idus=<?=$rst['id']?>" title="Editar dados" >Editar</a>
                                <a class="btn btn-danger" href="?acao=delet&idus=<?=$rst['id']?>" title="Excluir esse dado">Excluir</a>
                            </td>
                            <td><?=$rst['nome']?></td>
                            <td><?=$rst['marca']?></td>
                            <td><?='R$ '.number_format($rst['preco'], 2, ',', '.')?></td>
                            <td><?=$rst['quantidade']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>