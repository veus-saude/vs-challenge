<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.    A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

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

## Para levantar projeto

* git clone https://github.com/vitorapaiva/vs-challenge
* composer install
* Criar arquivo .env
* php artisan key:generate
* php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
* php artisan jwt:secret
* Configurar informações de seu banco de dados no seu .env
* php artisan migrate
* php artisan serve

## Para acessar a pagina do projeto

Acesse http://127.0.0.1:8000 (caso tenha utilizado o php artisan serve). Urls disponiveis:

* http://127.0.0.1:8000/: homepage, com lista de produtos;
* http://127.0.0.1:8000/add: criação de produto;
* http://127.0.0.1:8000/edit/{product_id}: edição de produto;
* http://127.0.0.1:8000/delete/{product_id}: remoção de produto;

* http://127.0.0.1:8000/brand: lista de marcas;
* http://127.0.0.1:8000/brand/add: criação de marca;
* http://127.0.0.1:8000/brand/edit/{brand_id}: edição de marca;

Para executar os testes, basta rodar vendor/bin/phpunit ou phpunit caso tenha ele instalado globalmente.

## Para consultas na api, utilize: 

* POST | api/v1/auth/authenticate
* POST | api/v1/auth/register
* GET  | api/v1/product/search

## Versionamento

Gestão de versionamento de api é feita através do arquivo routes/api.php. Basta adicionar novas rotas com a nova versão, apontando para os respectivos controllers.

### Parametros de busca aceitos:

* product_id      - Id numero do produto
* product         - Nome do produto
* brand           - Nome da marca do produto
* price_less_than - Busca por preco menor que o passado pelo usuario
* price_more_than - Busca por preco maior que o passado pelo usuario
* qty_less_than   - Busca por quantidade em estoque menor que o passado pelo usuario
* qty_more_than   - Busca por quantidade em estoque maior que o passado pelo usuario
* order_asc       - Orderna em ordem ascendente pelo nome do campo passado. Campos aceitos: product_id,brand_id,product_qty,product_price
* order_desc      - Orderna em ordem decrescente pelo nome do campo passado. Campos aceitos: product_id,brand_id,product_qty,product_price

### Parametros de paginacao aceitos:

* page - Indica pagina a ser trazida de total de paginas

O total de páginas, página atual e outras informações de paginação sao retornadas pelo sistema a cada requisição. Numa primeira busca, não é preciso passar page. Sistema assume 1 como padrão.

## Docker

Para utilizacao do docker, favor utilizar configuracao disponivel aqui: https://github.com/vitorapaiva/docker

## Live Version

É possivel visualizar o sistema em: http://vs-challenge.herokuapp.com/

## Implementações futuras

* Melhoria na interface
* Correções na mascara de preço que nao está funcionando na edicao de produto



