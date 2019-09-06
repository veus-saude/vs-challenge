# Básica API Rest com Laravel

API Rest usando Laravel com authenticação usando JWT

Luiz Carlos Belem `<belemlc@gmail.com>`
<small>(21) 97300-8600</small>
https://hub.docker.com/r/belemlc/api-laravel

## Instalação
    Usando o Docker
        1) Baixe a image que se encontra no docker hub
        2) docker pull belemlc/api-laravel
        3) docker-compose up --build
        4) git clone https://github.com/belemlc/api-laravel.git
        5) Para acompanhar evolução do container levantando [docker logs app -f]
        6) Porta Api 8000
        7) Porta Mysql 3308

    Usando o Laravel Development Server
        1) git clone https://github.com/belemlc/api-laravel.git
        2) cd api-laravel
        3) php artisan serve
        4) Porta da Api 8000
        5) Porta do Mysql 3307



## Gerar Produtos (opcional)
    Gerar Produtos Fakes com Tinker
       - Se tiiver usando Docker: docker exec -it app bash
       - php artisan tinker
       - factory('App\Models\Product', 50)->create()

## Usando a API

    Filtros
      - filter=brand:[BRAND_NAME]
      - sort=[COLUMN_NAME]:[asc|desc]
      - limit=[NUMBER_LIMIT_PER_PAGE]
     
    exemplo: ?filter=brand:marte&sort=name:desc&limit=10

* Endpoint para acessar a api
    http://localhost:8000/api/v1

## User Interface
    Foi criado uma interface básica com as seguintes funcionalidades: 
     - Listar produtos
     - Incluir um produto 
     - Excluir um produto
    
    Para acessar a aplicação basta fazer o clone ou fork em:
    https://github.com/belemlc/veus-challenge-angular.git

    No arquivo README explica como instalar, o mesmo pode ser instalado usando docker

## Unit Test
    * Não foi possível fazer.

