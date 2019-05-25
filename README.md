## Configurando o Projeto para executar o Desafio Veus

### Conceder permissão para a pasta de armazenamento
```bash
sudo chmod -R 777 storage/
```

### Como estou utilizando docker então é necessário criar a pasta volumes para ele armazenar nosso banco de dados.

```bash
mkdir volumes
```

Copiar o arquivo .env.example.

```bash
cp .env.example .env
```

## Docker Levantar os containers

```bash
docker-compose up
```

## Configurando Banco de dados

### Para acessar o container do Mysql basta digitar no terminal.

```bash
docker exec -it mysql_veus bash
```

Após isso temos que configurar nosso banco de dados e acessar o cliente do mysql para criar os databases.


```bash
mysql -U -pA123456
create database veus;
create database veus_test;
```


## Inicialização do Projeto

Entrar no bash do container apache_veus

```bash
docker exec -it apache_veus bash
```

Navegar até a pasta principal do projeto e instalar as dependências.

```bash
cd /var/www/html
composer install --ignore-platform-reqs
```

Após isso é só executar os comandos do artisan para criar a estrutura das tabelas, popular a base com alguns registros, gerar chaves para a authenticação da api e iniciar o servidor.

```bash
php artisan migrate
php artisan migrate --database=testing
php artisan db:seed
php artisan passport:install
php artisan serve
```
  
## Pegando IP que o Docker Gerou


```bash
docker inspect apache_veus | grep "IPAddress"
```
### Para acessar basta digitar http://{IP_QUE_DOCKER_GEROU}

## Executando os testes
### Para executar os testes basta entra no container do php e rodar o phpunit.

```bash
docker exec -it apache_veus bash

cd /var/www/html

./vendor/phpunit/phpunit//phpunit tests/
```

## Utilizando a API
## Link para documentação da API

```bash
https://documenter.getpostman.com/view/183210/S1TR5zi4
```

Será necessário gerar um token e quando for utilizar uma requisição autenticada devera enviar o Header Authentication Bearer $TOKEN que a API irá prover.

