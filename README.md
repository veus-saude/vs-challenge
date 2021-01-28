<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você utilize o framework **laravel** ou **lumen**. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto, não esquecendo as validações.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar __pagination__, __versioning__ e __sorting__.

A regra de negócio deve estar o mais **desaclopada** possível, dê O seu melhor, utilize todos os conceitos que conhecer sobre **orientação a objetos** e funcionalidades do framework escolhido.

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

**Diferenciais:**
* Docker
* Unit Test
* User Interface
* Clean Code
* DDD (Services e Repository)
* Modelagem de Dados

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entraremos em contato com você através do e-mail passando um feedback do seu projeto.
