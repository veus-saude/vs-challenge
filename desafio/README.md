# Iniciando
Basta executar o comando abaixo:
```
sh init.sh
```

Para explicação do funcionamento do SH segue abaixo detalhamento

## Iniciar o Projeto

Inicio o projeto utilizando o comando abaixo

```
docker-compose build && docker-compose up -d
```


## Executando Migrações
Para executar as migrações utilize o comando abaixo

```
docker-compose up -d migrate
```

## Populando o banco
Popule o banco utilizando o comando

```
docker-compose run --rm app php artisan db:seed
```

## Gerar Token para autenticação
O Banco contém um usuário válido **wilsantosdev@gmail.com**  senha **123456789**, que gerou o Token: 
```
Authorization
```
```
Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJlNWIzZmZjMmRkMTA5NDQyZGUwZTRiNzUzY2NhYmI1OWUzZTc3Nzg5MGU5NWM4YThlMjQ2MTFkNjEwYjhiNTNkYjM4NjA4ZDJlMGI0ZGIyIn0.eyJhdWQiOiIxIiwianRpIjoiMmU1YjNmZmMyZGQxMDk0NDJkZTBlNGI3NTNjY2FiYjU5ZTNlNzc3ODkwZTk1YzhhOGUyNDYxMWQ2MTBiOGI1M2RiMzg2MDhkMmUwYjRkYjIiLCJpYXQiOjE1NzE2Nzg2ODMsIm5iZiI6MTU3MTY3ODY4MywiZXhwIjoxNjAzMzAxMDgzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gwLErComYsKXvE1A16gIamr7UJIi9NNCYo4AwtCHwVpkfA2cZzjaXSdfPgrcYnxbg9oXWZZxj1nnc8X4oGw6R74etOrganc5JgRb3sGbw4Yj50WFWu0StqxDCgWR5z2Px-hB3fiviMqtaob-asQVcz-WCVLcBsAZEEGJFJHYNeE36bD5eFQnmJXM7WyMocH2icpBNlER9BSoOaWS3Al6pxIQCSCbIoCVQzn_0_mHVMtcHQJRu3ekXRp1RE0gQEloBhZoaP1T_t_Uyt-o1pXmE0bS6Ucv34PTuzXedQ_k9DwS9eGqlFiUMEuVibsjX4y8UmtDbP7BO9ZkSQqGfeFSxCsKI6Fi73TEzvB8sC538bErRDD8B0r3FdJisuAkH_ZcuxII1iIDZ-jgIA9fNcZZH5uGMIpV_fA_JpFlZ1qSIKfOT9-_7BfAeXi2Ms8afriOMoI3qhU3MH79UIiZWx8twE9AAqlV0aBXd2VpzxYYtU71w-zBw3RND_nQlYPb98vOZv5frbAncfpitWaK4KxaPyMlBanUs1TaCmzyIOD-YH3hAJLBKjxRZ897WoNfKSHDLLE1s3KnSlF0tIb7EvlCcQOLdoqUseJaqo2EMwSo8y6-EPfCsz544qcaKtn7BQ-iBJswfYupOGPPzupuQvd0zIMHaRS8l89GmuVxqkbHASI
```

Para gerar Token para um usuário novo , execute os comandos abaixo:
- Acesse o container `docker-compose run --rm app`
- Execute o comando `php artisan passport:keys` 
- Execute o comando `php artisan passport:client --password` que terá um retorno como exemplo:
```
Password grant client created successfully.
Client ID: 1
Client secret: ZvBQAZGg0EncAcL1Iv2ddEWCcV1rsKhJnhh22jOd
```

Utilize a secret para gerar o Token , com post para o endereço `localhost/oauth/token` com o comando abaixo ou com Postman ( Collection Junto ao Pull request )
```
curl localhost/oauth/token -H "Content-Type: application/json" -d '{"grant_type":"password","client_id": 1,"client_secret" : "ZvBQAZGg0EncAcL1Iv2ddEWCcV1rsKhJnhh22jOd","username" : "wilsantodev@gmail.com","password" : "123456789"}'
```


### API's do Desafio

| Rota                  | Method | Resultado                                                                                                                             |   |   |
|-----------------------|--------|---------------------------------------------------------------------------------------------------------------------------------------|---|---|
| /api/v1/products      | GET    | Retorna Lista de produtos Cadastrados.                                                                                                |   |   |
| /api/v1/products      | POST   |  Registro de Produto: campos: {"name" : string,	"brand" : string, "price" : float, "stock": integer} |   |   |
| /api/v1/products/{id} | GET    | Retorna dados do Produto buscando pelo {id}.                                                                                        |   |   |
| /api/v1/products/{id} | PUT    | Atualiza os dados do produto cuja {id} foi informada.                                                           |   |   |
| /api/v1/products/{id} | DELETE | Exclusão do produto pelo {id}.                                                                                          |   |   |


## Testes

Para realizar os testes automáticos basta executar o comando `vendor/bin/phpunit`



## Testando APIs
### Listagem de Produtos
```
http://localhost/api/v1/products
```

### Listagem de Produtos ordenada pelo campo e buscando genericamente no campo Nome e Marca
```
http://localhost/api/v1/products?sort[field]=name&sort[order]=asc&q=de
```

### Listagem de Produtos ordenada pelo campo e buscando no campo Nome e Marca usando paginação
```
http://localhost/api/v1/products?sort[field]=name&sort[order]=asc&q=de&page=2
```


