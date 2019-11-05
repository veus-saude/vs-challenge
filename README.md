## Informações e Instruções para rodar o projeto

O projeto foi construido com o framework Laravel, na versão 5.8 e php versão 7

Foi utilizado o banco de dados Mysql versão 5.7

Foi utilizado o phpUnit pra implementação dos testes.

O nome do banco de dados é veus.

## Como levantar o projeto

É necessário ter instalado no ambiente o mysql 5.7, compser 1.8.5 e npm 6.4.1

Na pasta raiz, executar no prompt de comando: "composer install", depois executar "npm install" e "npm run dev" para instalar as dependências do projeto.

Renomear o arquivo .env.example pra .env e alterar os parâmetros de acesso ao banco de dados, conforme exemplo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=veus
DB_USERNAME=veus
DB_PASSWORD=V3u$$istem

Caso a chave APP_KEY não esteja preenchida, executar no prompt de comando: "php artisan key:generate" na raiz do projeto.

## Testar o projeto

Foram criados migrations afim de facilitar a criação das tabelas necessárias no banco de dados.

Para executar as migrations digite: "php artisan migrate".

Para popular a tabela de produtos, executar o comando: "php artisan db:seed"

Para executar os testes automatizados, executar o comando: "composer test"

Para levantar o servidor local, executar no prompt de comando, na raiz do projeto: "php artisan serve"

## Testando as requisicoes

As URLs estão no seguinte formato:

http://localhost:8000/api/v1/register (POST) -> URL para criação de usuário:
Conteúdo do header da requisição:
    Content-Type: application/json
    Accept: application/json

Conteúdo do body da requisicao:
    {"name":"teste","email":"teste@gmail.com","password":"12345678","password_confirmation":"12345678"}
    
Token de autenticação retornado, que será necessário para as demais operações
    "api_token": "jQCZCdgTY19ywRcnxiBChDPhXpi7RK1naQhGwLYRaOzuQ7BsVCOUEBWQCrzX"

Informar o token no header da requisição:
    Authorization: Bearer "api_token": "jQCZCdgTY19ywRcnxiBChDPhXpi7RK1naQhGwLYRaOzuQ7BsVCOUEBWQCrzX"


http://localhost:8000/api/v1/login (POST)
    Login: informar email, senha e api_token
    
http://localhost:8000/api/v1/logout (POST)
    Logout: informar api_token
    
http://localhost:8000/api/v1/product (GET)
    Suporta query search como no exemplo:
        http://localhost:8000/api/v1/products?q=seringa&filter=brand:bunzl&sort=name
    Se não forem informados filtros, ele retornará todos os registros, paginados em 15 registros por página.
    
http://localhost:8000/api/v1/product (POST)
    Além dos dados do header, informas os dados abaixo para o cadastro
    {"name":"seringa","brand":"bunzl","price":"10","stock":"100"}
    
http://localhost:8000/api/v1/product/{id} (PUT)
    Além dos dados do header, informas os dados abaixo para atualização
    {"name":"seringa","brand":"bunzl","price":"10","stock":"100"}
    
http://localhost:8000/api/v1/product/{id} (DELETE)
    Além dos dados do header, informas o id para exclusão
    
http://localhost:8000/api/v1/product/{id} (GET)
    Informar o id para busca do produto.

## Observações

Iniciei o desenvolvimento da interface do usuário, mas não tive tempo hábil para conclusão, porém, decidi incluir uma pequena parte feita no projeto para que possa ser avaliado.

<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar __pagination__, __versioning__ e __sorting__.

Sinta-se livre para usar qualquer library ou framework da sua preferência mas a regra de negócio deve estar o mais desaclopada possível deles.

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

Bônus:
* Docker
* Unit Test
* User Interface

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.
