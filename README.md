## Instalação

O backend utilizado é o Laravel 8 e requer PHP 7.3+ para ser executado.


Instale as dependências após clonar o repositório

## BACKEND
- $ cd Veus-desafio
- $ composer install
- Alterar .env.example para .env 
- colocar os dados do seu banco no .env
- $ php artisan key:generate
- $ php artisan migrate:fresh
- $ php artisan serve


## Banco MYSQl
Criar um banco com nome "veus"

CREATE DATABASE `veus` /*!40100 COLLATE 'utf8mb4_general_ci' */



## MIGRATE
- php artisan migrate



## PASSPORT
- php artisan passport:install