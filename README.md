# Desafio Veus - BACKEND

### Instalação

O backend utilizado é o [Laravel 7](https://laravel.com/docs/7.x/installation) e requer PHP 7.2.5+ para ser executado.\
Frontend é feito usando o blade(laravel), bootstrap 4.5.

Crie o banco de dados
CREATE DATABASE veus_ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Instale as dependências após clonar o repositório

- BACKEND
```sh
$ cd veus_ecommerce
$ composer install
$ php artisan key:generate
$ php artisan migrate:fresh --seed;
$ php artisan passport:install --force
$ php artisan serve
```
- Credenciais
USUÁRIO: bruno.dn.fernandes@gmail.com
SENHA: 123456789

Link API
http://localhost:8000/api/v1/products
http://localhost:8000/api/v1/products?sort=preco:asc&q=agulha&filter=brand:BUNZL

AUTH: Bearer

Login
http://localhost:8000/api/auth/login

Views criadas
http://localhost:8000/login
http://localhost:8000/admin/listagem
http://localhost:8000/admin/cadastro_produtos
http://localhost:8000/site

Testes
test/Feature/ProductTest.php
test/Feature/UserTest.php

### Dependências e Libraries Backend

| Plugin | README |
| ------ | ------ |
| Laravel Passport | https://github.com/laravel/passport/blob/9.x/README.md |

### Dependências e Libraries Frontend

| Plugin | README |
| ------ | ------ |
| axios | https://github.com/axios/axios#readme |
| bootstrap | https://github.com/twbs/bootstrap#readme |
| jquery | https://github.com/jquery/jquery#readme |


