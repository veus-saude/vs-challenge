# Desafio Veus

## Descrição

Este projeto consiste em numa API REST com CRUD de produtos para laboratórios e hospitais. A API foi desenvolvida em PHP com o framework Laravel e banco de dados MySQL. A API possui autentificação através de token [JWT](https://jwt.io), e permite a busca de produtos utilizando filtros (*query string*) além de paginação e ordenação.

## Tecnologias

* PHP 7.3;
* Laravel 6.0.4;
* MySQL 5.7.27;

# Pré-requisitos

* Docker >= v19
* Docker-compose >= v1

## Instalação local (via Docker)

Siga os passos:

1. Navegue até a raiz do projeto e crie os containers docker.

* `docker-compose up -d`

> Por padrão a aplicação e banco de dados serão criados nas portas 8007 e 3007 respectivamente. Você pode especificar outra porta no arquivo `docker-compose.yml` na seção `ports` dos serviços `app` e `db`. Alterar também a porta na variável `APP_URL` do arquivo `.env`.

## Funcionamento

## Endpoints

## Postman

Na pasta `postman` estão compartilhados os arquivos com a collection (veus-challenge.postman_collection.json) e environment (veus-chanllenge.postman_environment.json) do Postman que servem como base para acessar todos os endpoints da API.

## Testes

Para executar os testes unitários rode o comando abaixo:

* vendor/bin/phpunit