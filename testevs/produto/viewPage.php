<?php
//Inicializando classe
require_once "../classes/Produto.class.php";

$classe = new Produto();

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

    <div class="container">
        <div class="row main-low-margin">
            <?php
            if(isset($_POST['btSalvar'])){
                if($classe->queryInsert($_POST) == 'ok'){
                    echo '<div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sucesso!</strong> Produto cadastrado com sucesso.
                    </div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Error!</strong> Erro ao tentar cadastrar esse associado.
                    </div>';
                }
            }

            if(isset($_POST['btEditar'])){
                if($classe->queryUpdate($_POST) == 'ok'){
                    echo '<div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sucesso!</strong> Cadastro atualizado com sucesso.
                    </div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Error!</strong> Erro ao tentar atualizar seu cadastro.
                    </div>';
                }
            }

            if(!empty($_GET["edit"]) == "ok") {
                $dados = $classe->querySeleciona($_GET['idus']);
            }
            ?>
            <div class="col-md-12">
                <form name="form" id="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-5 ">
                        <label>Nome: </label>
                        <input type="text" name="nome" class="form-control" value="<?= ((isset($dados['nome']))?($dados['nome']):('')) ?>" required>
                    </div>                
                    <div class="form-group col-md-3 ">
                        <label>Marca: </label>
                        <input type="text" name="marca" class="form-control" value="<?= ((isset($dados['marca']))?($dados['marca']):('')) ?>" required>
                    </div>                
                    <div class="form-group col-md-2 ">
                        <label>Preço: </label>
                        <input type="text" name="preco" class="form-control mask_moeda" value="<?= ((isset($dados['preco']))?($dados['preco']):('')) ?>" required>
                    </div>
                    <div class="form-group col-md-2 ">
                        <label>Quantidade: </label>
                        <input type="text" name="quantidade" class="form-control" value="<?= ((isset($dados['quantidade']))?($dados['quantidade']):('')) ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="submit" name="<?= ((isset($_GET['edit']))?('btEditar'):('btSalvar')) ?>" class="btn btn-success" value="<?= ((isset($_GET['edit']))?('Editar'):('Salvar')) ?>">
                        <input type="hidden" name="id" value="<?=$_GET['idus']?>">
                    
                        <a class="btn btn-primary" href="index.php" role="button">Voltar</a>
                    </div>
                </form>
            </div>
        </div>      
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

    <script>        
        $('.mask_moeda').mask('000.000.000,00', {reverse: true});
    </script>

</body>
</html>