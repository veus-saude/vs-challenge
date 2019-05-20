<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Configuração

A API utiliza variáveis de ambiente através de um arquivo .env que pode ser criada a partir do arquivo .env.example.

Para que a API consulte o banco de dados, se faz necessário informar as credencias de acesso neste arquivo.

## Instalação

A API utiliza três pacotes:

- illuminate/database
- illuminate/pagination
- vlucas/phpdotenv

Elas são necessárias para a execução da API e são instaladas via Composer através do seguinte comando:

*composer install*

<a href="https://getcomposer.org/download/">Baixar Composer</a>

Feito isso, é necessário executar o seguinte comando para a inserção de tabelas e registros no banco de dados:

*php import_dump.php*

Pronto! A API pode ser servida através do servidor web embutido do PHP.

*php -S localhost:8000*

## Autorização

Para acesso a API, o token de um usuário deve ser informado através de uma requisição de cabeçalho.

Exemplo: curl http://localhost:8000/v1/products --header "api_token: token"

## Endpoints

/v1/products/ Recupera todos os produtos

/v1/brands/ Recupera todas as marcas

## Parâmetros

"q": Pesquisa por string

"q-column": Define a coluna a pesquisar

"sort": Classifica o resultado por uma coluna

"sort-order: Define a direção da classificação (asc ou desc)

"filter": Filtra através de um relacionamento (exemplo: localhost:8000/v1/products/?filter=brand:EMS)
