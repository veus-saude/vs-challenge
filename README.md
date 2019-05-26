## Instação

$ cd vs-challenge
$ composer install
```

Criar o arquivo .env
```
$ cp .env.example .env

Alterar os dados de conexão com o banco de dados.

```

Gerar a chave da aplicação
```
$ php artisan key:generate
```

Gerar o JWT secret
```
php artisan jwt:secret
```
Criar as tabelas e executar os seeds para inserir os produtos
```
$ php artisan migrate --seed

Iniciar a aplicação
```
$ php artisan serve
```
Para testar as requisições
```
No diretório /img_teste_postaman contém as imagens com testes no postman

Import o arquivo vs-challenge.postman_collection.json para o postman

```