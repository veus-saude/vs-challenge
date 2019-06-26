# veus-project

Projeto da VEUS feito por Rodrigo Marques

#Instalação

git clone https://marquescoti@bitbucket.org/marquescoti/veus-project.git
composer install
renomear .env.example para .env
rodar o comando php artisan key:generate

Alterar as propriedades de conexão com o banco de dados no arquivo .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=veusdb
DB_USERNAME=root
DB_PASSWORD=

#Configuração
Criar um novo usuário
POST: http://localhost/veus-project/public/save
Parametros
    name
    email
    password

Gerar um token
GET http://localhost/veus-project/public/token
Parametros
    email
    password
    
Enviar o token por HEADER através
Bearer Token ( Authorization: Bearer {yourtokenhere} )

Consultas 
http://localhost/veus-project/public/api/v1/products?order=preco&filter=marca:POLO

#Testing
No do banco de dados: veusdbteste
php artisan migrate --database=testing
Rodar teste: 
./vendor/bin/phpunit