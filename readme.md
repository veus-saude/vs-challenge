PROCESSO DE INSTALAÇÃO
- 0 - Criar a pasta de volumes na raíz do projeto
- 1 - Ir na pasta do projeto e rodar o comando docker-compose up -d
- 2 - verificar o ip do container com o comando docker inspect apache_veus
- 3 - configurar o .env copiando do .env.example
- 3.1 - rodar o composer install --ignore-platform-reqs
- 4 - Entrar no container do mysql: docker exec -it mysql_veus  bash
- 4.1 - Criar as databases veus e veus_test (mysql -u root -p (A123456) - create database veus; create database veus_test;)
- 5 - Entrar no container apache_veus (docker exec -it apache_veus  bash) e ir na pasta do projeto (cd /var/www/html) e rodar o php artisan migrate && php artisan migrate --database testing && php artisan passport:install
- 6 - Acessar a url localhost 

-------

- para rodar os testes na raíz do projeto rodar o comando ./vendor/phpunit/phpunit/phpunit 