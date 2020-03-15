## Instruções para implementação

### Dependências

Docker e docker-compose instalados.

### Iniciar os containers do docker através do docker-compose

Para permitir persitência de dados do mysql ao subir e derrubar os container é necessário criar uma pasta vazia.

Crie o diretório **mysql-data** na raíz do projeto.

Em seguida, também na raíz do projeto executar:

**docker-compose up --build**

### Realizar o composer install para receber todas as dependências de pacotes

Nao raiz do projeto executar **composer install**

### Copiar configurações

Copiar arquivo **.env.example** para **.env**

### Executar comando para criar banco de dados

Existe um comando customizado para criar o banco de dados inicial:
**php artisan db:create** que pega as informações do .env e cria o banco.

### Executar migrations e seeds para criar o banco de dados

Executar **php artisan migrate:fresh --seed**

### Corrigir permissões de pastas iniciais

Executar na raíz do projeto:

>sudo chgrp -R www-data storage bootstrap/cache
>
>sudo chmod -R ug+rwx storage bootstrap/cache

Referência: https://laracasts.com/discuss/channels/general-discussion/laravel-framework-file-permission-security

### Setup do Passport

Para autenticação foi utilizado o [Passport](https://laravel.com/docs/5.8/passport) , biblioteca mantida pela equipe do laravel.

Nas migrations suas tabelas base serão criadas. Após isso basta executar:

**php artisan passport:install**

Onde a saída irá gerar duas chaves, que deverão ser guardadas e usadas na requisição de autenticação.

**client_id** e **client_secret** do item Password grant


Exexplo:

`
php artisan passport:install

Encryption keys generated successfully.

Personal access client created successfully.

Client ID: 1

Client secret: sT7ordadNmPz34pc5XQBygmP9oPkHYHSONNTZAKG

Password grant client created successfully.

Client ID: 2

Client secret: xyhLnUVx9kBUCH4sZ0tqNk2OxEjx0DPUTB8yFKld
`


### Collection do Postman

Para facilitar o comsumo da API , existe um arquivo de collections do Postman na pasta **postman** do projeto.

Referência: https://learning.postman.com/docs/postman/collection-runs/working-with-data-files/

### Usuário inicial

A API permite criar usuários , mas já contém 1 padrão para testes.

username: loxas@loxas.com.br

password: 123mudar!@

### Teste de acesso e url

http://localhost:8080/ deve mostrar a página de instalação do laravel se tudo ocorreu corretamente.


## Bibliotecas usadas

#### Autenticação

https://laravel.com/docs/5.8/passport

#### Filter & sorting

https://github.com/spatie/laravel-query-builder

#### Pagination

https://github.com/spatie/laravel-json-api-paginate

#### Migrations

Seeds (criar baseado no banco): https://github.com/orangehill/iseed

Migrations (criar baseado no banco) : https://github.com/Xethron/migrations-generator

#### Versioning

Adotei uma solução própria para criar esta feature.


## Pontos de melhoria

Acredito que atendi os requistos solicitados mas ainda gostaria de implementar algumas melhorias.
A autenticação é a mesma para as duas versões da API e seria interessante uma api_key para isolar os acessos.

<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível utilizando os frameworks *Laravel, Lumen ou Synfony*. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar __pagination__, __versioning__ e __sorting__.

Sinta-se livre para usar qualquer library ou framework da sua preferência mas a regra de negócio deve estar o mais desaclopada possível deles.

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

Bônus:
* Docker
* Unit Test
* User Interface

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.
