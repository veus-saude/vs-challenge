# CRUD API - Desafio Veus Technology

## Sem frameworks. Utiliza PHP, SQLite e JWT. 

(Por motivo de falta de tempo, ainda existem alguns bugs e diversos error handlings a serem implementados. Porém, a API funciona como esperado.)

## Iniciando o servidor
Execute "start_server.bat". A API será servida em "localhost:3000".

## Autenticação:
Para gerar um token de autenticação:
```
POST http://localhost:3000/auth
JSON
    {
        "user_name": "demo",
        "password": "demo"
    }
```
## Interagindo com a API
Para consultar todos os registros de produtos:
```
http://localhost:3000/api/v1/products
```
Para consultar um registro de produto específico pela id:
```
GET http://localhost:3000/api/v1/products?product_id={id}
```
Para criar um novo registro de produto:
```
POST http://localhost:3000/api/v1/products/create
JSON
    {
        "product_name": {nome},
        "brand": {marca},
        "price": {preço},
        "amount": {quantidade}
        "token": {token}
    }
```
Para apagar um registro de produto específico pela id:
```
DELETE http://localhost:3000/api/v1/products/delete
JSON
    {
    	"product_id": {id}
        "token": {token}
    }
```

Para atualizar um registro de produto específico pela id:
```
PUT/PATCH http://localhost:3000/api/v1/products/update
    {
        "product_id": {id},
        "product_name": {nome},
        "brand": {marca},
        "price": {preço},
        "amount": {quantidade}
        "token": {token}

    }
```

### Filtros de busca:

Para aplicar filtros de busca, deve-se utilizar os seguintes parâmetros na query string:
* "q": Filtra por nome.
* "brand": Filtra por marca.
* "price": Filtra por preço.
* "amount": Filtra por quantidade.
```
Exemplo: http://localhost:3000/api/v1/products?q=caixa&filter=brand:Healthgard
```
Também poder ser aplicados os seguintes operadores:
 * "[gte]": Maior ou igual
 * "[lte]": Menor ou igual
 * "[eq]": Igual
 * "[gt]": Maior
 * "[lt]": Menor
```
Exemplo: http://localhost:3000/api/v1/products?price[gte]:200&amount[lt]:20
```

### Ordenação:

Para aplicar modificadores de ordenação, deve-se utilizar os seguintes parâmetros na query string:
* "q": Ordena por nome.
* "brand": Ordena por marca.
* "price": Ordena por preço.
* "amount": Ordena por quantidade.
```
Exemplo: http://localhost:3000/api/v1/products?order=price
```
Para ordenar de maneira decrescente, deve-se utilizar o modificador "[desc]:
```
Exemplo: http://localhost:3000/api/v1/products?order=amount[desc]
```

### Paginação:

Para aplicar modificadores de paginação, deve-se utilizar os parâmetros "offset" e "limit" na query string:
```
Exemplo: http://localhost:3000/api/v1/products?limit=20&offset=5
```
