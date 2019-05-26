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
        </div>
    </nav>
    
    <div class="container" id="titulo-pagina">
        <div id="contato">
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3" id="titulo">Escopo</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <p>Implementar uma API de manutenção e busca de produtos que atenda aos seguintes requisitos técnicos e de negócios:
<br/>
- Use PHP > 7;
<br/>
- e-commerce de produtos para laboratórios e hospitais;
<br/>
- O cliente deve conseguir buscar pelos campos diponiveis;
<br/>
- O cadastro de produtos possuir telas de CRUD de produtos;
<br/>
- A API deve requerer autenticação;
<br/>
- A API deve permitir search query através do método GET;
<br/>
- A API deve suportar filtros opcionais nos campos do produto;
<br/>
- A API também deve suportar pagination, versioning e sorting;</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container" id="titulo">
        <div id="contato">
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3" id="titulo">Pré Requisitos</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <p>
- Versão do PHP maior que 7.
<br/>
- É necessário possuir um banco de dados MySQL com um usuário com permissão de criação de tabelas, selecionar e atualizar.
<br/>
- É necessário ter o Composer instalado para executar.
<br/>
- Executar o comando "composer update na pasta ./api".
<br/>
- Criar Schema do banco de dados com a "CREATE SCHEMA veus_sc_produto DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;".
<br/>
- Se estiver usando o Linux dar permissão de leitura na pasta "./api/app/config" para criação da conexão ao banco de dados.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container" id="titulo">
        <div id="contato">
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3" id="titulo">Setup</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="conteudo">
        <div id="contato">
            <div class="row">
                <div class="col-md-12 order-md-1">
                    <form class="validar" novalidate id="formContato">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <p>Entre com os dados de conexão com o banco de dados para criação do arquivo de conexão e tabela. O usuário deve possuir permissão para criação de tabela (CREATE TABLE), selecionar (SELECT) e atualizar (UPDATE).</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="host">DB Host (caminho do banco de dados)*</label>
                                <input type="text" class="form-control" id="host" placeholder="localhost" required>
                                <div class="invalid-feedback" id="host-msg">
                                    Coloque um host válido.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="schema">DB Schema (nome do banco de dados)*</label>
                                <input type="text" class="form-control" id="schema" placeholder="veus_sc_produto" required>
                                <div class="invalid-feedback" id="schema-msg">
                                    Coloque um schema válido.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario">Usuário*</label>
                                <input type="text" class="form-control" id="usuario" placeholder="usuario db" required>
                                <div class="invalid-feedback" id="email-msg">
                                    Coloque um usuário válido.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" placeholder="">
                                <div class="invalid-feedback" id="email-msg">
                                    Coloque uma senha válida.
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">
                        <div class="row">
                            <div class="offset-md-5 col-md-3 mb-3">
                                <button class="btn btn-light btn-block" id="btn-limpar" type="reset">Limpar</button>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-primary btn-block insert" id="btn-salvar" type="submit">Configurar e criar tabela</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <footer class="my-3 text-muted text-center text-small">
            <p class="mb-1">&copy; 2019 - Caio Santos</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="http://santoscaio.com" target="_blank">santoscaio.com</a></li>
            </ul>
        </footer>
    </div>

    <div id="mascara">
        <div id="timer"><img id="img-gif" src="img/ajax-loader.gif"></div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/holder.min.js"></script>
    <script src="js/custom.js"></script>
    </body>
</html>
