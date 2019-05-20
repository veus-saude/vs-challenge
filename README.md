<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar __pagination__, __versioning__ e __sorting__.

Sinta-se livre para usar qualquer library ou framework da sua preferência mas a regra de negócio deve estar o mais desaclopada possível deles.

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.

---

# Como utilizar?

> Obrigado pela oportunidade prestar este desafio!

Após clonar o projeto para a sua máquina, utilize respectivamente os seguintes comandos:

 1. `composer install`
 2. `php -r "file_exists('.env') || copy('.env.example', '.env');"`
 3. Configure corretamente suas conexões com a base de dados no arquivo `.env` criado pelo comando acima. Verifique se a base de dados configurada já foi criada. 
 4. `php artisan migrate --seed`
 5. Acesse o projeto pelo browser da maneira que preferir e crie um novo usuário clicanco em `Register` no canto superior direito da tela
 6. No menu lateral clique em `Profile` e copie sua token para utilzar na API

Para demonstrar o versionamento da API, simulei 4 endpoints diferentes (ou seja, minha API supostamente tem 4 versões). A v4 possui todas as funcionalidades pedidas pelo desafio. Abaixo segue um exemplo de como testei minha API via cURL:

```cURL
curl -X GET \
  'http://veus.test/api/v4/products?sort=brand' \
  -H 'Accept: application/json'
```

Com o comando acima os produtos serão listados em páginas de 15 itens ordenados pelo nome da marca.