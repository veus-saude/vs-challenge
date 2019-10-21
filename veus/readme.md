# Instalação

## Aplicação

Necessário possuir composer e npm instalados.

1. Clone o projeto executando: `git clone https://github.com/dcatein/vs-challenge.git`

2. Navegue até a pasta criada contendo o projeto, execute `./run.sh` isso fará com que as dependências sejam instaladas (composer e npm).

3. Para iniciar a aplicação execute `php artisan serve`

## API

Após os passos acima citados, para que as API's sejam acessadas é necessário alguns passos para autenticação.

1. Gerando as chaves: `php artisan passport:keys`

2. Gerando o client secret: `php artisan passport:client --password`  pressione Enter para que a opção Default seja selecionada.
Isso deve gerar uma saída como essa:
Client ID: 3
Client secret: zdZAA8FLM3NC0CZCAKTz40NJF4bOQE4yKxhH6Qca

3. Gerando o token: Neste passo, para gerar o token precisaremos realizar uma requisição para a rota __localhost:8000/oauth/token__ informando o client id e o client secret gerados anteriormente, como por exemplo:
`curl localhost:8000/oauth/token -H "Content-Type: application/json" -d ': "password","client_id": 3,"client_secret" : "zdZAA8FLM3NC0CZCAKTz40NJF4bOQE4yKxhH6Qca","username" : "ab@ab.com","password" : "12345678"}'`

E a resposta deve ser algo como:

{
  "token_type": "Bearer",
  "expires_in": 31622400,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFlYWE3ZjQ5MDY0ZjE4ODlhYmM0ZDllY2IxMTkxYTk2ZWI4NjM4MmI3NThiNjFmZTgxMmI1NGI0NjJiODNjOWNhYjdlMjMyY2M4MTg2NWQ1In0.eyJhdWQiOiIzIiwianRpIjoiYWVhYTdmNDkwNjRmMTg4OWFiYzRkOWVjYjExOTFhOTZlYjg2MzgyYjc1OGI2MWZlODEyYjU0YjQ2MmI4M2M5Y2FiN2UyMzJjYzgxODY1ZDUiLCJpYXQiOjE1NzE2Mzc2NjUsIm5iZiI6MTU3MTYzNzY2NSwiZXhwIjoxNjAzMjYwMDY1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.UTSRQulXR6V49jPhKiRvlMQlvA2oNs2rfH5EpnOXBovYmnuooZhGo7-t2iGen4NjOceGRhq91BO1a6XG6Y3F99NIke9vV-rKnOxqh1jKzT3kBOfb-6zCLmGfmRF81xXByB7fOrD1tJ-EreLHf1vQ0ZfpPZuaG_8UfZuqkY-TstCCjhHWJgznCrtKiYKhQHlzMBviZMEm7pfExi6Tmv3SYW46lJqNCNOp_trWvvGACJVNYB_5Ll9RdWdClrAMBHw9Bf4nC2Bqxcm1rV5bAf8NfAsNnjoU8nM8Fwck33BTnBgsWnHfd3DZwDX0dfH_GuHuTHsvt4_FL8rW3sxhNxAsB_U-scIpigwhWjeaon2oG2hLbjkGsSsTGF8bRLCFRVS1fgAKSkHpMBM-dWRSXhwVIHMz0G8wPCdFmPG7O7yw0WOOJu8AeVCaVcmKfyVGGXMJ4e0VODwQAzQIqiYqL3ZY3AnN3_jHJienLfe2ekaeExlo1qbS9WdM1m6RS2nSg_-Gr3dLk2wa152FOfZZEsT_6mQ55qZArAgUp-Bi5M0t6ZwMFBe-vzX5dxPWdvWs_-fTyJsioI1UAfjm1c2NtLktjJAwia4fFuyQ5jxO66M-QU20t7o90ZP1NQh38r2k1ZYQjj-xCsDt3D3Y3fomzbQNofYBzbF3M0qoIlPi0Fyb6TE",
  "refresh_token": "def5020016bc568398cfcaa51ab3974bc5b84b234fda15a779617f3d74627022328481b0c60f30e745c8eb36b09dbb9b857a6d6db0f53fffab27c7a04deefc52958801740304189072e422d61e3df2ef430f48f0698e822829171bd2ed0953b70eadb192d5665938ac66afe44fba4f3fd114fed2495bab34073fdd47112ed114aec0a8fa6a2b84a347089dee608b07585cc494ba3050145bc1fb3491f8a7cee759a038ec1ecef0bc8d13ed6a70fcdd2d3a6d5ed169bee578f1f37066dd65e8c8a64b65af2853b9d6fa2b67a4aee710a51c3c3d7989d9c54d9f60727741641c761953df31bf802e22bed6b6847cd5a84606ffec53ad711346b822e08a2ed5189cc994e3b89f4c059ac73010fd1e043b8dd0dfc4c7a5cb46c7ad8c5171f4af1fad4028ee8e5972787ce5ef2bfa6da9e1c9d1e4b1c29e658cc6e695993db23df9eed8304f409e12badaee273457a71a4b8ec12ec47bf73e1b95565561ff3c6468c2f3"
}

Obs.: O username ab@ab.com informado no exemplo é funcional, porém caso queira criar um novo usuário, acesse a aplicação é selecione Register no menu superior.

4. Após completar os passos até aqui, já é possível realizar as requisições para as API's da aplicação substituindo o header Authorization pelo acess_token gerado anteriormente, no seguinte formato:
curl localhost:8000/api/v1/products -H "Accept: application/json"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBiYjY1Y2Y1ZDgwYmY0ZDU4ZDliMjg0YjI5MDcyYjNmZjQ2N2Q1NWJkYzQ0OTRmNzg4NzU4YTEzZDUyZTFkNzY3NTA1MTc4YzQzMWQyZTVlIn0.eyJhdWQiOiIzIiwianRpIjoiMGJiNjVjZjVkODBiZjRkNThkOWIyODRiMjkwNzJiM2ZmNDY3ZDU1YmRjNDQ5NGY3ODg3NThhMTNkNTJlMWQ3Njc1MDUxNzhjNDMxZDJlNWUiLCJpYXQiOjE1NzE2MzU4ODUsIm5iZiI6MTU3MTYzNTg4NSwiZXhwIjoxNjAzMjU4Mjg1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.i9FqMSv61l6CVp-Rh_SF__v6n_bWR151K8EaIwxpjRxRa4WyI-0LPKMQ8TV419lgZ09ujvqbwD5YyBjNyjZFDcv3QijBtynwamug68M5Il92a6rCtbOOQHnYB0gLMefdB-C-0CkgpQYuqcXnNZdXZruKyTI4Qa6v3ORrqhVntBUmhmUZ5qiSIQYWl9A5kTqJz1JUFAwcop30z3PtsSL5SuoG_RqJXrD1MTuj3Cegd_hPDks-7wEpPCNoYBFUhfqnAzBlSi9FsmJmKhR_NqetE1Wa1XkVco2lVmuA_P6nPcCvXcmMy6_epdUWQ29mgWPJIEBa5ShJuACZfAjw69id8roBzRPyk8PlLFFt25_G2xg-YbiCBBXVLejHrULpYA99wcFU6V6Sx3vF5JdmOa_t5ZmWLmkXhoyqe8rOplZsfEHeiNxQN7iKNiiQm7UVFeK-Jv4DNbWHm68abDv2dTqIiG9DBWPCPLQQKUG7snZKvevpJrGAkKotFO80yy-CjqF80u6aPF8t81wk_YRihcvKE9o86-Zw9vxRxzfx1ClLpdknIURXh_ykRbg_9YpL4cHYtEQ3eT62kOVArKw-fu8s2U7J6vCzsJUmJLA7RikYb1uI_lCA8S7ek2YnT8FrWER-HwaRjM778cHGXTzcPF0hwmilLpWx_3UIZBdPQsCOL-w"


### Search
Para realizar search basta informar o parametro __q__, por exemplo: `/api/v1/products?q=ser`

### Pagination
A paginação é feita por Default com 3 itens por página, o parametro __per_page__ controla isso, por exemplo: `/api/v1/products?per_page=4`.
Para acessar as páginas seguintes da lista, basta informar o parametro __page__, exemplo: `/api/v1/products?page=2`

### Sort
Para realizar a ordenação dos resultados informe o parametro __sort__ com os subitens __[field]__ e __[order]__, exemplo: `/api/v1/products?sort[field]=marca&sort[order]=asc`, o campo __[order]__ é opcional, seu valor default é "asc".
Os valores possíveis para o campo __[field]__ são "marca","nome","preco" e "quantidade".

### Filter
Os filtros so feitos informando o parametro __filter__ no formato __[campo]=valor__, por exemplo: `/api/v1/products?filter[marca]=B`


### API's disponiveis

| Rota                  | Method | Resultado                                                                                                                             |   |   |
|-----------------------|--------|---------------------------------------------------------------------------------------------------------------------------------------|---|---|
| /api/v1/products      | GET    | Retorna todos os produtos cadastrados.                                                                                                |   |   |
| /api/v1/products      | POST   | Aceita um JSON com os parametros para registrar um produto, exemplo: {"nome" : "aa",	 "marca" : "BB", "preco" : 100, "quantidade" : 2} |   |   |
| /api/v1/products/{id} | GET    | Retorna o produto referente ao {id} informado.                                                                                        |   |   |
| /api/v1/products/{id} | PUT    | Realiza o Update do produto referente ao {id} informado através de um JSON.                                                           |   |   |
| /api/v1/products/{id} | DELETE | Apaga o produto referente ao {id} informado.                                                                                          |   |   |

