

# API - Veus Technology

Esta API foi desenvolvida para uma teste proposto pela empresa Veus Technology.
A API é dá acesso aos produtos registrados no sistema.

Para iniciar, dê os seguintes passos:
##### - Crie um banco de dados MySQL e faça as devidas alterações no arquivo .env.
##### - Utilize o comando _php artisan  _jwt:secret_  para gerar a chave secreta do JWT.
##### - Utilize o comando _php artisan migrate_ para criar as tabelas do banco de dados.
##### - Utilize o comando _php artisan db:seed_ para criar um usuário. Lembre-se de preencher as suas informações no arquivo .env (APP_USER_NAME, APP_USER_EMAIL E APP_USER_PASSWORD).
##### - Utilize o comando _php artisan serve_ iniciar o servidor.

Recursos disponíveis para acesso via API:
* [**Produtos**](#produtos)

## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |
| `PUT` | Atualiza dados de um registro ou altera sua situação. |
| `DELETE` | Remove um registro do sistema. |


## Respostas

| Código | Descrição |
|---|---|
| `200` | Requisição executada com sucesso (success).|
| `302` | Registro encontrado no banco de dados (success).|
| `401` | Usuário não autorizado (não logado no sistema).|
| `404` | Recurso não encontrado (Not found).|
| `422` | Erros de validação ou os dados informados estão fora do escopo definido para o campo.|
| `500` | Erro interno do servidor.|

### Autenticação com JWT
##### Qualquer requisição não autenticada retornará a seguinte resposta:
+ Response 401 (application/json)

          {
             'error' : "Você não está logado.",
             'errCode' : 401
          }
          
 
### Rotas de Autenticação
##### Login [POST /auth/login]
Obter token de acesso.
+ Request (application/json)
    + Body

            {
                "email" : "your_email@email.com",
                "password" : "your_password"
            }
    + Response 200 (application/json)
        
            {
                "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.",
                "token_type": "bearer",
                "expires_in": 3600
            }

##### Refresh token [POST /auth/refresh] 
Atualizar o token do usuário.
+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

    + Response 200 (application/json)
    
            {
                "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.",
                "token_type": "bearer",
                "expires_in": 3600
            }

##### User details [POST /auth/me] 
Dados do usuário.
+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

    + Response 200 (application/json)
    
            {
                "id": 1,
                "name": "User name",
                "email": "user@email.com",
                "email_verified_at": 20/12/2020,
                "created_at": 20/12/2020,
                "updated_at": 20/12/2020
            }
            
##### Logout [POST /auth/logout] 
Dados do usuário.
+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

    + Response 200 (application/json)
    
            {
              "message": "Successfully logged out"
            }
            


## Listar
As ações de `listar(index)` permitem o envio dos seguintes parâmetros:

| Parâmetro | Via URL| 
|---|---|
| `q` | q=value |
| `filter` | filter=value. |

_Exemplo:_ `https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

# Recursos

<a id="produtos"></a>
# Produtos [/products] 

Os produtos são identificados por um código único.

### Listar (index) [GET]
Todos os registros. 

+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

    + Response 200 (application/json)

			[

					{

					"id": 1,

					"name": "Product Name",

					"brand": "Brande",

					"price": "100.00",

					"amount": 1

					},

					{

					"id": 2,

					"name": "Product Name",
					
					"brand": "Brand",

					"price": "10000.00",

					"amount": 2

					}

			]

### Novo (store) [POST]

+ Request (application/json)
     + Attributes
			
            + name :string
            + brand :string
            + price:decimal(10,2)
            + amount :integer 

    + Headers

            Authorization: Bearer [access_token]

    + Body

			{

					"name": "Product Name",

					"brand": "Brand",

					"price": "10000.00",

					"amount": "1",

			}

+ Response 200 (application/json)

    + Body

			{

					"name": "Product Name",

					"brand": "Brand",

					"price": "10000.00",

					"amount": "1",

					"id": 4

			}

### Detalhes (show) [GET /products/{id}]

+ Parameters
    + code (required, integer, `1`) ... Código do produto

+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

+ Response 302 (application/json)
  Detalhes do produto

    + Body

			{

					"name": "Product Name",

					"brand": "Brand",

					"price": "10000.00",

					"amount": "1",

					"amount": 1

			}

### Editar (update) [PUT  /products/{code}]

+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

    + Body

            {
                "name": "New product name",
                "brand": "New product brand",
                "price": "New product price",
                "amount": "New product amount (integer)"
            }

+ Response 200 (application/json)

    + Body

            true (´1´)

            
### Editar (update) [PUT  /products/{code}]

+ Request (application/json)

    + Headers

            Authorization: Bearer [access_token]

	+ Response 200 (application/json)


	    + Body

	            true (´1´)