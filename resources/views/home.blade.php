<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Veus</title>
        <link href="{{ asset('css/lib/bootstrap.min.css') }}" rel="stylesheet" >
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" >
    </head>
    <body>
    <div id="login" style="display:none">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" onsubmit="login(this);return false;" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="email" name="email" id="email" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Senha:</label><br>
                                    <input type="password" name="password" required="required" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="LOGIN">
                                    <a href="javascript:showFormAddUser()" style="color:#747474">cadastrar novo usuário</a>
                                </div>                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add-user" style="display:none">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" onsubmit="addUser(this);return false;" method="post">
                            <h3 class="text-center text-info">Cadastro</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Nome:</label><br>
                                    <input type="text" name="name" id="username" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="email" name="email" id="email" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Senha:</label><br>
                                    <input type="password" name="password" id="password" required="required" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="CADASTRAR">
                                </div>                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="logged" class="container" style="display:none">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="text-right">
                        <a href="javascript:logout()" style="color:#747474;">sair</a>
                    </div>

                    <form method="GET" id="search-form">
                        <div class="row" style="padding:20px;">
                            <div class="col-10">
                                <input name="q" id="search" class="form-control form-control-lg" placeholder="Busque por um produto" style="width:100%" />
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary btn-lg">Procurar</button>
                            </div>
                        </div>
                        <table id="products" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th data-sort="name" class='th-name'>Nome</th>
                                    <th width="20%" data-sort="brand" class='th-brand'>Fabricante</th>
                                    <th  width="20%" data-sort="price" class='th-price'>Preço</th>
                                    <th width="10%" data-sort="quantity" class='th-quantity'>Quantidade</th>
                                    <th width="10%" >Ações</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th><input name="brand" class="form-control" /></th>
                                    <th><input name="price" class="form-control"/></th>
                                    <th><input name="quantity" class="form-control"/></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </form>

                    <button class="float-right btn btn-success" id="add-new-product" style="margin:20px 0">Adicionar Novo Produto</button>

                    <div style="clear:both"></div>

                    <form id="add-product" onsubmit="addProduct(this); return false;" style="display:none">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" id="add-name" name="name"  placeholder="Nome do produto">        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fabricante</label>
                            <input type="text" class="form-control" id="add-brand" name="brand"  placeholder="Fabricante do produto">        
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Preço</label>
                            <input type="number" step="0.01" class="form-control" id="add-price" name="price"  placeholder="Preço do produto">        
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantidade</label>
                            <input type="number" step='1' class="form-control" id="add-quantity" name="quantity"  placeholder="Quantidade do produto">        
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    <script>
        var baseUrl = '{{env('APP_URL')}}';
    </script>
        <script src="{{ asset('js/lib/bootstrap.min.js') }}" type="text/javascript"  defer></script>
        <script src="{{ asset('js/lib/jquery.min.js') }}" type="text/javascript"  defer></script>
        <script src="{{ asset('js/custom.js') }}" type="text/javascript"  defer></script>

    </body>
</html>





