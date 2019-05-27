# Desafio VS

## Iniciando

```bash
$ git clone https://github.com/DaviFreire/crud_api.git
$ cd crud_api
$ docker-compose up
```

## Criando token de acesso

```bash
$ docker-compose exec app php artisan passport:client --client
```

O comando acima irá retornar uma mensagem no formato abaixo:

```
Password grant client created successfully.
Client ID: 3
Client Secret: RZZyELdtmVrFmujA7NLCep9srvSHsvz91bVTtnnh
```

Para obter o token de acesso é preciso realizar a requisição na url `http://localhost/api/v1/oauth/token` com o seguinte application/json:

```
{
    "grant_type": "client_credentials",
    "scope": "*",
    "client_id": "[CLIENT_ID]",
    "client_secret": "[CLIENT_SECRET]"
}
```

Onde `CLIENT_ID` e `CLIENT_SECRET` são os valores da mensagem cima.

## API

Utilizando o token no `header` como `Authorization` do tipo `Bearer`, podemos realizar as seguintes operações:

```
GET     'http://localhost/api/v1/products';
POST    'http://localhost/api/v1/products';
PUT     'http://localhost/api/v1/products/{id}';
DELETE  'http://localhost/api/v1/products/{id}';
```

Para o método GET podemos passar os seguintes parâmetros:

- `q` - Filtra o nome do produto
- `filter` - Filtra o produto pelos seus campos. Ex.: `http://localhost/api/v1/products?filter=brand:BUNZL`
- `page` - Seleciona a página a ser retornada
- `l` - Quantidade de registros por página
- `sort` - Ordena a busca. Ex.: `http://localhost/api/v1/products?sort=brand:desc`

## Seeding

Use o seguinte comando para popular o banco com dados fictícios:

```bash
docker-compose exec app php artisan db:seed
```

