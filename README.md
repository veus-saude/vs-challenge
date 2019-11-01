Desafio Veus
==================================
Eu iria configurar o swagger para a aplicação porém como demorei demais para entregar o sistema e sob pena de vocês terminarem o processo antes de eu poder terminar a api segue essa pequena documentação de uso:

# Lista de comandos em ordem para ultilizar a aplicação
1 - Baixe a aplicacao:

 ```''
  git clone ... ou download
  git checkout <branch>
 ``` 

2 - levante o servidor:

* Entre no diretorio e suba os containeres
```
  cd challenge/
  docker-compose up -d
```

**Notas:** A aplicação ira rodar na parta 8080 se você precisar alterar a porta as configurações estão dentro do docker-compose.yml

3 - Baixe os bundles da aplicação:

```
  cd app
  composer install 
```

**Notas:** Caso não tenha o php7.3 instalado na maquina a partir daqui entre dentro container do php com o comando: docker exec -it -u www-data api-php-fpm bash 
é recomandado não usar o composer install com o root por isso a adição -u www-data


**Observação:** Uma das vezes que rodei o comando para testar,
o composer não conseguiu baixar um dos pacotes rodei mais uma vez e tudo funcionou.

4 - crie tabelas para o banco de dados

```
php bin/console doctrine:migrations:migrate 
```
**Notas:** Ainda dentro de app

5 - cria dados para testes no banco de desenvolvimento

```
php bin/console doctrine:fixtures:load -n
```

**Notas:** Ainda dentro de app

Pronto serviço ativo e api funcionando!

# Informações sobre a aplicação:

Resolvi usar jwt simples como autenticação por se tratar apenas de um teste o que quer dizer que o token é sempre o mesmo e único para cada cliente segue o usuario e o token de teste:
```
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.-m3IoKses9ullRykqBJ30M2NGquYFKWyvCDV24LuNJc

Login:
http://host.docker.internal:8080/security/login Post 
json:
{
	"username":"usuario",
	"password":"123456"
}

```

# Lista completa dos endpoints do sistema:

    www-data@b17a3f0edc50:/application/app$ php bin/console debug:router
    ------------------------- -------- -------- ------ ------------------------------
    Name                      Method   Scheme   Host   Path                         
    ------------------------- -------- -------- ------ ------------------------------
    app_rest_product_list     GET      ANY      ANY    /api/{version}/products
    app_rest_product_create   POST     ANY      ANY    /api/{version}/products
    app_rest_product_show     GET      ANY      ANY    /api/{version}/products/{id}
    app_rest_product_delete   DELETE   ANY      ANY    /api/{version}/products/{id}
    app_rest_product_update   PUT      ANY      ANY    /api/{version}/products/{id}
    get_user                  GET      ANY      ANY    /api/{version}/users/{user}
    get_users                 GET      ANY      ANY    /api/{version}/users
    security_login            POST     ANY      ANY    /security/login
    security_register         POST     ANY      ANY    /security/register
    ------------------------- -------- -------- ------ ------------------------------

As versões possiveis no arquivo .env:
* API_VERSIONS=(v0.8|v1.0|v1.1|v1.2|v1.3);

Endpoint Principal como esta configurado:

Dentro do arquivos de fixtures são gerados valores aliatorios para consulta inicial:

Sendo que os valores possiveis no momento são:

* names = ['seringa', 'antitérmico', 'analgésico', 'pomada para queimaduras']
* brands = ['Negócio em cápsula','EMS Corp','Hypermarcas','Sanofi','Novartis','Aché','Eurofarma','Takeda']

```
http://host.docker.internal:8080/api/v1.1/products?q=seringa&filter=brand:EMS Corp&page=1&size=1

```

Sendo 
page = a pagina que se quer buscar 
size = o numero de elementos por pagina 
q = query os valores estão sendo buscados apenas dentro de nome posso ter entendido o desafio de maneira errada nesse quesito mas 
se a ideia é buscar dentro de nome e marca a alteração seria pequena e não dolorosa
filter: ele esta buscando sem `LIKE` e com `AND` a mesma explicação do quesito acima

**Notas:** Esta é uma chamada de exemplo que pode não trazer nada em razão dos valores para teste serem aliatorios.

# Rota para adição de usuario

```
http://host.docker.internal:8080/security/register
json:
{
	"username":"usuarioqualquer",
	"password":"senhaqualquer"
}

```
# Para rodar os testes:

Dentro do diretorio app rode o comando 


```
root@b17a3f0edc50:/application/app# php bin/phpunit
PHPUnit 7.5.17 by Sebastian Bergmann and contributors.

Testing Project Test Suite
.......                                                             7 / 7 (100%)

Time: 7.83 seconds, Memory: 6.00 MB

OK (7 tests, 19 assertions)
````

 *Tive que usar o host.docker.internal na configuração do nginx para poder rodar os testes dentro do container, sem nenhuma configuração adicional no pessoa que vai usar o sistema. No windows na instalação do docker normalmente ele cria esse endereço no hosts do windows não testei no linux por isso não posso dizer que ira funcionar nele.*




