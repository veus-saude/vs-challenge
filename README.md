<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Introdução
API para cadastrar e consultar os produtos de um e-commerce

## Tecnologias utilizadas
Laravel
MySQL
Obs: Necessária a instalação do composer - https://getcomposer.org/

## Instalação
 * Rodar o comando composer install para instalar as dependêcnias da aplicação
 * Criar um arquivo .env igual ao arquivo .env.example que já vem na pasta raíz da aplicação e configurar:
    * Porta de acesso(DB_PORT)
    * Nome da base de dados(DB_DATABASE)
    * Endereço(DB_HOST)
    * Usuário e senha(DB_USERNAME / DB_PASSWORD)
 * Rodar o comando php artisan key:generate
 * Rodar o comando php artisan migrate para criar as tabelas no banco de dados
 * Rodar o comando php artisan db:seed para criar produtos fakes no banco de dados e criar o usuário para testar a API(Email: veus.technology@gmail.com / Senha: Veus@123)
 * Rodar o comando php artisan jwt:secret para gerar a chave que irá assinar os tokens
 * Para testar localmente, rodar o comando php artisan serve para subir um servidor para a aplicação
 

## Autenticação
Para realizar o login e gerar o token de acesso, deve ser feita uma requisição POST para **http://localhost:8000/api/v1/auth/login** conforme imagem abaixo
<p align="center">
    <img src="https://imgur.com/Uph6Fxb.png">
</p>

Se necessário, o logout deve ser feito informando o token recebido no login, em uma requisição POST para **http://localhost:8000/api/v1/auth/logout** conforme imagem abaixo
<p align="center">
    <img src="https://imgur.com/KNWzKoM.png">
</p>

_________________________

## Endpoints
**Lista todos os produtos cadastrados**

**GET** - **http://localhost:8000/api/v1/products**

**Filtros de pesquisa e ordenação** - Possibilidade de filtrar por nome e marca do produto e ordenar por qualquer campo(ID, name, brand, price ou amount). Nas imagens abaixo temos exemplos de filtros por nome e marca, somente nome, somente marca e a ordenação está sendo feita pelo id do produto de forma crescente.
URL completa: **http://localhost:8000/api/v1/products?q=DOL&filter=BRAND:SCHUMM&sort=id,asc**
Obs: Se nenhum parâmetro de ordenação for informado, a ordenação será feita pelo campo "name" de forma crescente(asc)
<p align="center">
    <img src="https://imgur.com/3J26mPM.png">
</p>
<p align="center">
    <img src="https://imgur.com/K4NPjwY.png">
</p>
<p align="center">
    <img src="https://imgur.com/S6CWwN3.png">
</p>

**Recupera as informações de um produto específico**

**GET** - **http://localhost:8000/api/v1/products/id_produto**

**Cadastra um novo produto**

**POST** - **http://localhost:8000/api/v1/products**
<p align="center">
    <img src="https://imgur.com/aYyAFh2.png">
</p>

**Altera um produto**

**PATCH** - **http://localhost:8000/api/v1/products/id_produto**
<p align="center">
    <img src="https://imgur.com/xIr14xm.png">
</p>

**Remove um produto**

**DELETE** - **http://localhost:8000/api/v1/products/id_produto**
<p align="center">
    <img src="https://imgur.com/VAahTOA.png">
</p>


