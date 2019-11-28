<?php

function pretty_print($json_data) {

    //Initialize variable for adding space
    $space = 0;
    $flag = false;

    //Using <pre> tag to format alignment and font
    echo "<pre>";

    //loop for iterating the full json data
    for($counter=0; $counter<strlen($json_data); $counter++) {

        //Checking ending second and third brackets
        if ( $json_data[$counter] == '}' || $json_data[$counter] == ']' ) {
            $space--;
            echo "\n";
            echo str_repeat(' ', ($space*2));
        }


        //Checking for double quote(“) and comma (,)
        if ( $json_data[$counter] == '"' && ($json_data[$counter-1] == ',' || $json_data[$counter-2] == ',') ) {
            echo "\n";
            echo str_repeat(' ', ($space*2));
        }

        if ( $json_data[$counter] == '"' && !$flag ) {
            if ( $json_data[$counter-1] == ':' || $json_data[$counter-2] == ':' ) {

                //Add formatting for question and answer
                echo '<span style="color:blue;font-weight:bold">';
            } else {

                //Add formatting for answer options
                echo '<span style="color:red;">';
            }
        }

        echo $json_data[$counter];

        //Checking conditions for adding closing span tag
        if ( $json_data[$counter] == '"' && $flag )
        echo '</span>';

        if ( $json_data[$counter] == '"' )
        $flag = !$flag;

        //Checking starting second and third brackets
        if ( $json_data[$counter] == '{' || $json_data[$counter] == '[' ) {
            $space++;
            echo "\n";
            echo str_repeat(' ', ($space*2));
        }
    }
    
    echo "</pre>";
}

?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Documentação - {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- jQuery -->
        <script src="/js/jquery.min.js"></script>
        
        <!-- Styles -->
        <link rel="stylesheet" href="/css/custom.css?update={{ Str::random(3) }}" />
        <link rel='stylesheet' href='/css/docs.css?update={{ Str::random(3) }}' />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="/">Início</a>
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Cadastre-se</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            <div class='content'>
                
                <h1 class="mytitle"><img src='/img/logo-white.png' class='logodocs' /> &nbsp; Documentação API Rest</h1>
                
                <div class="topic">
                    <h3 class="module">Login</h3>
                    <p class="article">
                        <span class="method">Headers (2)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        <br>
                        <span class="method">POST</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/auth/login</span><br>
                        <br>
                        <span class="method">Parâmetros</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;email: <span class="route">Email cadastrado no banco de dados</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;password: <span class="route">Senha cadastrada para o email informado</span><br>
                        <br>
                        <span class="method">Retorno</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;token_type:   <span class="route">Bearer</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;access_token: <span class="route">Você deve armazenar este token para enviar nas próximas requisições</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;expires_at:   <span class="route">Data e hora de expiração do token. Formato: Y-m-d H:i:s</span><br>
                    </p>
                </div>
                <div class="topic">
                    <h3 class="module">Listar Produtos</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">GET</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/products</span><br>
                        <br>
                        <span class="method">Parâmetros (opcionais)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;q: <span class="route">Busca do produto por nome</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;filter: <span class="route">Filtro por marca</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;sort: <span class="route">Ordenação desejada</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;page: <span class="route">Página Desejada</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;*** <i>Observação: A API retorna o máximo de 20 resultados a cada página</i><br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 1: &nbsp;&nbsp;
                            <span class="route">/api/v1/products?q=seringa</span>
                            </i>
                        <br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 2: &nbsp;&nbsp;
                            <span class="route">/api/v1/products?q=seringa&filter=brand:Farmaceutica%20S.A.</span>
                            </i>
                        <br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 3: &nbsp;&nbsp;
                            <span class="route">/api/v1/products?q=seringa&filter=brand:Farmaceutica%20S.A.&sort=name|desc,id|desc</span>
                            </i>
                        <br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 4: &nbsp;&nbsp;
                            <span class="route">/api/v1/products?filter=brand:Farmaceutica%20S.A.&sort=name</span>
                            </i>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span><br>

                        
                            <?php echo pretty_print('{"current_page":1,"data":[{"id":2,"name":"Seringa - Cirúrgico","brand_id":3,"created_at":"2019-11-27 13:18:50","updated_at":"2019-11-27 13:18:50"},{"id":3,"name":"Esterilizador - Par","brand_id":10,"created_at":"2019-11-27 13:18:50","updated_at":"2019-11-27 13:18:50"}],"first_page_url":"http:\/\/desafio-veus.test\/api\/v1\/products?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/desafio-veus.test\/api\/v1\/products?page=1","next_page_url":null,"path":"http:\/\/desafio-veus.test\/api\/v1\/products","per_page":20,"prev_page_url":null,"to":2,"total":2}'); ?>
                        
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Cadastrar Produtos</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">POST</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/products</span><br>
                        <br>
                        <span class="method">Parâmetros (obrigatorios)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;name: <span class="route">Nome do produto</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;brand_id: <span class="route">ID da marca do produto</span><br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span><br>

                        
                            <?php echo pretty_print('{"name":"produto teste 2","brand_id":"3","updated_at":"2019-11-27 22:33:42","created_at":"2019-11-27 22:33:42","id":22}'); ?>
                        
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Editar Produto</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">PUT</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/products/</span><span class="method">{product_id}</span><br>
                        <br>
                        <span class="method">Parâmetros</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;name: <span class="route">Nome do produto</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;brand_id: <span class="route">ID da marca do produto</span><br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"id":22,"name":"produto teste","brand_id":"3","created_at":"2019-11-27 22:33:42","updated_at":"2019-11-27 22:51:49"}'); ?>
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Detalhar Produto</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">GET</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/products/</span><span class="method">{product_id}</span><br>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"id":22,"name":"produto teste","brand_id":"3","created_at":"2019-11-27 22:33:42","updated_at":"2019-11-27 22:51:49"}'); ?>
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Excluir Produto</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">DELETE</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/products/</span><span class="method">{product_id}</span><br>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"success":true,"message":"Produto excluído com sucesso"}'); ?>
                    </p>
                </div>
                
                
                
                <div class="topic">
                    <h3 class="module">Listar Marcas</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">GET</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/brands</span><br>
                        <br>
                        <span class="method">Parâmetros (opcionais)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;q: <span class="route">Busca da marca por nome</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;sort: <span class="route">Ordenação desejada</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;page: <span class="route">Página Desejada</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;*** <i>Observação: A API retorna o máximo de 20 resultados a cada página</i><br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 1: &nbsp;&nbsp;
                            <span class="route">/api/v1/brands?q=Farmaceutica%20S.A.</span>
                            </i>
                        <br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 2: &nbsp;&nbsp;
                            <span class="route">/api/v1/brands?q=Farmaceutica%20S.A.&sort=name</span>
                            </i>
                        <br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 3: &nbsp;&nbsp;
                            <span class="route">/api/v1/brands?q=Farmaceutica%20S.A.&sort=name|desc</span>
                            </i>
                        <br>
                        
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo 4: &nbsp;&nbsp;
                            <span class="route">/api/v1/brands?sort=name</span>
                            </i>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span><br>

                        
                            <?php echo pretty_print('{"current_page":1,"data":[{"id":3,"name":"Farmaceutica S.A.","created_at":"2019-11-27 13:11:15","updated_at":"2019-11-27 13:11:15"}],"first_page_url":"http:\/\/desafio-veus.test\/api\/v1\/brands?page=1","from":1,"last_page":1,"last_page_url":"http:\/\/desafio-veus.test\/api\/v1\/brands?page=1","next_page_url":null,"path":"http:\/\/desafio-veus.test\/api\/v1\/brands","per_page":20,"prev_page_url":null,"to":1,"total":1}'); ?>
                        
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Cadastrar Marcas</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">POST</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/brands</span><br>
                        <br>
                        <span class="method">Parâmetros (obrigatorios)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;name: <span class="route">Nome da Marca</span><br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span><br>

                        
                            <?php echo pretty_print('{"name":"Umbrella Coorporation","updated_at":"2019-11-27 23:08:42","created_at":"2019-11-27 23:08:42","id":21}'); ?>
                        
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Editar Marca</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">PUT</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/brands/</span><span class="method">{brand_id}</span><br>
                        <br>
                        <span class="method">Parâmetros</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;name: <span class="route">Nome do marca</span><br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"id":21,"name":"Umbrella Coorporation","created_at":"2019-11-27 23:08:42","updated_at":"2019-11-27 23:08:42"}'); ?>
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Detalhar Marca</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">GET</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/brands/</span><span class="method">{brand_id}</span><br>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"id":21,"name":"Umbrella Coorporation","created_at":"2019-11-27 23:08:42","updated_at":"2019-11-27 23:08:42"}'); ?>
                    </p>
                </div>
                
                <div class="topic">
                    <h3 class="module">Excluir Marca</h3>
                    <p class="article">
                        <span class="method">Headers (3)</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Content-Type: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Accept: <span class="route">application/json</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Authorization: <span class="route">Bearer</span> + (um espaço) + <span class="route">access_token</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<i> ----- Exemplo (Authorization): <span class="route">Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJ...</span> ----- </i><br>
                        <br>
                        <span class="method">DELETE</span><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Rota: <span class="route">/api/v1/brands/</span><span class="method">{brand_id}</span><br>
                        <br>
                        
                        <br>
                        <span class="method">Exemplo de Retorno</span>
                        <br>
                        <?php echo pretty_print('{"success":true,"message":"Marca excluída com sucesso"}'); ?>
                    </p>
                </div>
                
            </div>
        </div>
        
        <script src="/js/custom.js?update={{ Str::random(3) }}" />
    </body>
</html>
