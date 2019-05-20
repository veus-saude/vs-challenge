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

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.



apilumen

API simples desenvolvido em Lumen 5.8.

Ao rodar esse projeto, será possível consumir uma API que se loga em um sistema para consumir busca de medicamentos. A estrutura da API foi desenvolvida camadas para se tratar melhor os dados, onde o Controller só recebe os dados e envia para uma classe de Service para tomar as decisões. Na Service é feito o envio dos dados para realizar Validação em suas devidas classes de Validações, enviado dados para classes de Repository para se interagir com banco de dados, e após tudo ser salvo no banco de dados, é devolvido para a interface através da API a resposta de sucesso, ou os dados solicitados caso seja uma requisição do tipo GET.

Para rodar esse projeto, é necessário ter instalado:

    Git;
    Composer;
    PHP 7.1 >;
    Mysql;

Instalação

    git clone git@github.com:fmontilla/vs-challenge.git
    Entrar na pasta do projeto via terminal e dar permissão 777 para a pasta storage
    Entrar na pasta do projeto via terminal e rodar o comando composer install
    Configurar no arquivo .env os dados de conexão ao banco de dados
    Rodar no terminal o comando php artisan migrate --seed
    Rodar o comando php artisan serve para iniciar o servidor da aplicação ou configurar a aplicação para rodar encima de outro servidor, por exemplo nginx, xampp, wamp, etc

Na raiz da aplicação há um arquivo para importar no Postman para realizar teste do consumo da API. No consumo da roda de busca de medicamentos, coloquei uma validação para sempre informar todos os campos de busca. Realizei dessa maneira apenas para mostrar um pouco de validação, mas poderia ter desenvolvido sem a necessidade de informar na url todos os campos de busca.

