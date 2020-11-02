<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando _PHP_ > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível utilizando os frameworks _Laravel, Lumen ou Synfony_. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir **search query** através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar **pagination**, **versioning** e **sorting**.

Sinta-se livre para usar qualquer library ou framework da sua preferência mas a regra de negócio deve estar o mais desaclopada possível deles.

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

Bônus:

-   Docker
-   Unit Test
-   User Interface

---

Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.

---

**Abaixo dados da instalação do projeto**

Depois de baixar o projeto dentro da pasta executar os comandos abaixo.

Executar **composer install**

Executar o **cp .env.example .env**

Editar o **.env** e alterarar o banco para **veus_test**, colocar a senha **root**

Executar o **php artisan jwt:secret**

executar o **docker-compose up** Obs.: O banco de dados esta usando a porta 3306, caso precise alterar a porta editar o arquivo **docker-compose.yml** e alterar para a porta desejada, não esquecer de alterar também dentro do **.env**

Executar **php artisan migrate**

Executar **php artisan db:seed** para criar o usuário.

Esta sendo criado o usuário **fernando@gmail.com** com a senha **123456**

Executar **php artisan serve** -> para subir o servidor no http://localhost:8000

foi utilizado o insominia para os testes e dentro da pasta do projeto tem o export com o nome **Insomnia_fernando.json**

é preciso se autenticar para obter o token e usar nas requisições.

para isso acessando pelo insominia executar o endpoint **Auth - authenticate**

irá fazer o login com os dados de usuário já cadastrado.

obtendo o token somente incluir nos endpoints criados no insominia na aba **Bearer**
