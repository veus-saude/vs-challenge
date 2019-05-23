#Teste Veus Joziel Reis

###Metodos de executar o teste.

####Docker
Instale o Docker e o docker-compose para rodar o projeto.
Utilize o comando na raiz do projeto:

    docker-compose up -d

####PHP Server

Requisitos para rodar o php server:
- php 7
- composer
- extensão: pdo_sqlite
- extensão: mbstring


Utilize o comando na raiz do projeto:

    composer install
    php -S localhost:8000 -t public


###Executando o Projeto.

O projeto utiliza o Swagger, para visualizar a API entre na Home do Projeto. exemplo:

    http://localhost

O projeto utiliza como banco o SQLite, para executar as função é necessário o TOKEN do usuário.

Para encontrar o TOKEN você pode utilizar a consulta no banco que se localiza na pasta:

    ./storage/sqlite/veus.sqlite

Ou você pode utilizar a API:

    http://localhost/api/v1/users

Essa Rota está liberada, não precisa utilizar o TOKEN para ser executada, porém o restante do projeto é necessário do TOKEN.

####Como utilizar o TOKEN.

O TOKEN deve ser utilizado na HEADER da requisição
exemplo via CURL:

    curl -X GET "http://localhost/api/v1/products?q=seringa&filter=brand:BUNZL" -H "accept: */*" -H "Authorization: Bearer {TOKEN API}


####Testes Unitários
Para os Testes foi Utilizado o PHPUnit, basta executar na raiz do projeto o comando:

    php ./vendor/phpunit/phpunit/phpunit

####Resetar base de dados
Caso queria resetar o banco e alimentar ele com novos dados faça as seguintes ações:

Delete o arquivo `http://localhost/api/v1/users` e recrieo com o mesmo nome.

Utilize os commando em sequencia a seguir:

    php artisan migrate
    php artisan 
    php artisan db:seed --class=UsersSeeder
    php artisan db:seed --class=BrandsSeeder
    php artisan db:seed --class=TypesSeeder
    php artisan db:seed --class=ProductsSeeder
    
    

#####Contato
Para mais informações entre em contato via e-mail: joziel99@gmail.com