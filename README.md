
# Documentação Desafio Veus (Yago Henrique)

Instalação:

1 - git clone https://github.com/yagodevweb/vs-challenge.git

2 - composer install

3 - Crie um banco de dados com o nome veus (HeidiSQL, PhpMyAdmin, Sequelpro), 
está definido root e sem password o acesso ao banco de dados no arquivo .env

4 - php artisan migrate --seed

5 - login para acesso: admin@veus.com | senha: secret


## User Interface Veus

Página de login

    Contém toda a parte de autenticação do Laravel

Página Home

    Contém o total de produtos
    Contém a aquisição (created_at) de produtos por mês (Gráfico dinâmico detalhando)

    OBS: Por padrão quando você rodar a migrate será criado produtos do mês anterior 
    e o atual para alimentar o gráfico

Página de Produtos

    Cadastro do Produto
    Edição do Produto
    Exclusão do Produto (em duas formas, única e múltipla)
    Pesquisa
    Ordenação
    Paginação

    OBS: todas as páginas está com com a navegação (cabeçalho) a disposição do usuário,
    e também com flash messages para o feedback do usuário.


## Api Veus (Utilizei o Postman, mas fique a vontade para usar qual preferir)

Autenticação da Api feita com Jwt-Auth
    
    Utilize o método POST para geração do token passando o body (email e password)
    email: admin@veus.com | password: secret

    http://localhost/vs-challenge/public/api/v1/auth/login

Para Acessar as rotas utilize o token gerado acima para Authorization (Bearer Token)

    Listagem de produtos (Método GET)

    Exemplos:

    http://localhost/vs-challenge/public/api/v1/products

    Listagem de produtos com filtro (Método GET)

    Exemplos:

    http://localhost/vs-challenge/public/api/v1/products?q=name&filter=brand:marca

    OR

    Filtros suportados (=, >, <, <>, >=, <=)

    http://localhost/vs-challenge/public/api/v1/products?q=name&filter=quantity:>:10


Paginação de produtos

    Exemplos:

    (Por padrão o total de resultados por página é 10)
    http://localhost/vs-challenge/public/api/v1/products?paginate=true

    OR 

    (Definindo quantos registros quer trabalhar por página)
    http://localhost/vs-challenge/public/api/v1/products?paginate=true&per_page=5


Ordenação de Produtos

    (Você pode definir por qual campo quer ordenar e também (ASC OR DESC))
    http://localhost/vs-challenge/public/api/v1/products?sort_by=name:asc


Observação

    O desenvolvedor tem toda a liberdade para ir encadeando os métodos acima em 
    uma única consulta


- CRUD da Api

Exemplos:

    Leitura (GET)
    http://localhost/vs-challenge/public/api/v1/products/1

    Cadastro (POST)
    http://localhost/vs-challenge/public/api/v1/products
    Campos obrigatórios: (name, brand, price, quantity)

    Edição (PUT)
    http://localhost/vs-challenge/public/api/v1/products/1
    Campos obrigatórios: (name, brand, price, quantity)

    Exclusão (DELETE)
    http://localhost/vs-challenge/public/api/v1/products/1
