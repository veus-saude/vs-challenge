<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <title>Produtos</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/fontawesome-all.min.css" rel="stylesheet">
    </head>

    <body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-box-open"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarProduto" aria-controls="navbarProduto" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarProduto">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="produto.php">Produtos <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="titulo-pagina">
        <div class="row">
            <div class="col-md-2">
                <h4 class="mb-3" id="titulo">Produtos</h4>
            </div>
            <div class="col-md-2 text-right">
                <button type="button" class="btn btn-info" id="new"><i class="fas fa-plus"></i> Novo</button>
            </div>
            <div class="col-md-2 text-right" id="div-espaco">
                &nbsp;
            </div>
            <div class="col-md-2 text-right">
                <select class="form-control" id="select-filtro">
                    <option value="0">Filtro</option>
                    <option value="brand">Marca</option>
                    <option value="value">Valor</option>
                    <option value="quantity">Quantidade</option>
                </select>
            </div>
            <div class="col-md-2 text-right" id="div-valor-filtro">
                <input type="text" class="form-control" id="valor-filtro" placeholder="Valor Filtro">
            </div>
            <div class="col-md-4">
                <form id="formBusca">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="busca" placeholder="Busca (id, nome ou marca)" aria-label="Busca" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="find" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <input type="hidden" value="" id="pos-busca" />
            <input type="hidden" value="" id="pos-filtro" />
        </div>
    </div>

    <div class="container" id="conteudo">
        <div id="produtoform">
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <form class="validar" novalidate id="formContato">
                        <input type="hidden" value="" id="idproduto" />
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name">Nome*</label>
                                <input type="text" class="form-control" id="name" placeholder="" maxlength="60" required>
                                <div class="invalid-feedback" id="name-msg">
                                    Nome é requerido.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="brand">Marca*</label>
                                <input type="text" class="form-control" id="brand" placeholder="" maxlength="60" required>
                                <div class="invalid-feedback" id="brand-msg">
                                    Marca é requerida.
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="value">Valor*</label>
                                <input type="text" class="form-control money" id="value" placeholder="R$ 0,00" maxlength="13" required>
                                <div class="invalid-feedback" id="value-msg">
                                    Valor é obrigatório.
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="quantity">Quantidade*</label>
                                <input type="text" class="form-control quantidade" id="quantity" placeholder="" maxlength="4" required>
                                <div class="invalid-feedback" id="quantity-msg">
                                    Quantidade é obrigatório.
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mb-4">
                        <div class="row">
                            <div class="offset-md-6 col-md-3 mb-3">
                                <button class="btn btn-light btn-block" id="btn-limpar" type="reset">Limpar</button>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary  btn-block insert" id="btn-salvar" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-3" id="titulo2"></h5>
            </div>
        </div>
        
        <div id="produtotable">
            <div class="table-responsive">
                <table class="table table-sm thead-dark table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col"><a class="ordenacao" ord-field="id_product" ord-tipo="a">#</a></th>
                            <th scope="col"><a class="ordenacao" ord-field="name" ord-tipo="a">Nome</a></th>
                            <th scope="col"><a class="ordenacao" ord-field="brand" ord-tipo="a">Marca</a></th>
                            <th scope="col"><a class="ordenacao" ord-field="value" ord-tipo="a">Valor</a></th>
                            <th scope="col"><a class="ordenacao" ord-field="quantity" ord-tipo="a">Quantidade</a></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-content">

                    </tbody>
                </table>
            </div>
        </div>

        <footer class="my-3 text-muted text-center text-small">
            <p class="mb-1">&copy; 2019 - Caio Santos</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="http://santoscaio.com" target="_blank">santoscaio.com</a></li>
            </ul>
        </footer>
    </div>

    <div class="modal fade" id="alertMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Mensagem do sistema</h5>
                </div>
                <div class="modal-body" id="modalMsg">

                </div>
                <div class="modal-footer">
                    <button type="button" id="modalBtnNao" class="btn btn-danger" data-dismiss="modal">Não</button>
                    <button type="button" id="modalBtnFechar" class="btn btn-dark reload" data-dismiss="modal">Fechar</button>
                    <button type="button" id="modalBtnSim" valor="" class="btn btn-success">Sim</button>
                </div>
            </div>
        </div>
    </div>

    <div id="mascara">
        <div id="timer"><img id="img-gif" src="img/ajax-loader.gif"></div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/holder.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/jquery.maskMoney.js"></script>
    <script src="js/actions.js"></script>
</body>
</html>
