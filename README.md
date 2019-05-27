#Como rodar

Executar o comando:

`git submodule update docker && cd docker && docker-compose up -d`

Após os containers subirem:

`docker-compose exec workspace composer install && docker-compose exec workspace php artisan migrate --seed` 

A API possui os métodos GET, POST, PUT e DELETE. 

**É necessário passar um input chamado `api_token` com qualquer valor para realizar a autentição.**

**GET**

url: http://localhost/api/v1/products/ID

e

url: http://localhost/api/v1/products

Query Search: `q=STRING`

Campos elegiveis para *sort* e *filter* `brand, quantity, price` no formato:

`filter=CAMPO:VALOR` e `sort=CAMPO:VALOR`

Paginação: `page=NUMERO`

Regras de validação para criação **POST**: 

url: http://localhost/api/v1/products
```php
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.01,9999.99',
            'thumbnail' => 'required|string|max:255',
            'quantity' => 'required|integer'
```
Regras de validação para edição **PUT**: 

url: http://localhost/api/v1/products/ID
```php
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.01,9999.99',
            'thumbnail' => 'required|string|max:255',
            'quantity' => 'required|integer'
```
**DELETE**:

url: http://localhost/api/v1/products/ID
###Testes:

Rodar:
`docker-compose exec workspace ./vendor/bin/phpunit`

## Observações

Utilizei o service container do lumen para versionar a api. O arquivo config/api.php define 
as implementações para cada versão da api. Essas interfaces são utilizadas no controller.

Uma problema que eu percebi assim que finalizei o projeto é a validação dos requests dentro
do Controller. Uma vez que eu uso as interfaces para conseguir realizar o versionamento da api,
percebi que a validação dos requests deveria seguir o mesmo processo, garantindo a re-usabilidade 
dos controllers.

Espero que goste e não ache overengineering. Abraços!




