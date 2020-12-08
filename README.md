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

---

**INSTRUÇÕES**

Executar **composer install**

Executar o **cp .env.example .env**

Editar o **.env** e alterarar o banco para **veus** e colocar a senha **root**

**php artisan migrate:refresh --seed**

**CREDÊNCIAIS**

Usuário: admin@veus.com.br

Senha: 123456

Api TOken Inicial: PMAxBMu4PwEMUCHm2DgItFfozk3l4kBqSGf1suKgvUMof4M2GqrIwqbLIzlv

**API ENDPOINTS**

**POST: /api/v1/auth**

AUTH: Auth Basic

Gera um novo TOKEN de acesso passando as credências usuário e senha

**GET: /api/v1/products?q=porto&filter=brand:BUNZL&sort=name,asc&page[size]=10&page[number]=1**

AUTH: Bearer

Retorna os produtos baseado nos filtros

**GET: /api/v1/brands**

AUTH: Bearer

Retorna todas a marcas