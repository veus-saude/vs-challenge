## Pré requisitos

Para a possível execução do projeto é necessário possuir o seguinte ambiente: 

- PHP >= 7.0 [Windows](https://www.php.net/manual/pt_BR/install.windows.php), [Linux](https://www.php.net/manual/pt_BR/install.unix.debian.php).
- Docker [Windows](https://docs.docker.com/docker-for-windows/install/), [Linux](https://docs.docker.com/install/linux/docker-ce/ubuntu/).
- Github [Windows](https://git-scm.com/download/win), [Linux](https://git-scm.com/book/pt-br/v1/Primeiros-passos-Instalando-Git).
- Composer [Windows](https://getcomposer.org/download/), [Linux](https://getcomposer.org/doc/00-intro.md).

Após preparar o ambiente siga as intruções abaixo.

## Baixando o projeto

#### Windows
Abra sua Linha de Comando navegue até o diretório onde deseja baixar o projeto
Execute o comando:
```shell
  $ git clone https://github.com/filipebsmonteiro/veus-challenge
```
- Aguarde o sistema ser baixado.
-  Navegue para dentro do diretório criado (veus-challenge)
 
<hr>

#### Linux
Abra o Terminal navegue até o diretório onde deseja baixar o projeto
Execute o comando:
```shell
  $ git clone https://github.com/filipebsmonteiro/veus-challenge
```
- Aguarde o sistema ser baixado.
-  Navegue para dentro do diretório criado (veus-challenge)
  


## Rodando o projeto
- Copie o arquivo .env.example somente para o nome .env  
- Execute um por um os comandos abaixo:
```
 $ composer install
 $ docker-compose up -d
 $ php artisan db:create
 $ php artisan migrate
 $ php artisan db:seed
 $ php artisan passport:install
 $ php artisan serve
```

Ao executar o comando <u>php artisan passport:install</u> serão geradas 2 Senhas para acesso à API    
 Exemplo de Senhas: 
 ```
 Personal access client created successfully.
 Client ID: 1
 Client secret: gxuOGgkAVbhPQRFaZZpsZ9lFs06yFeBEebyUvgBK
 Password grant client created successfully.
 Client ID: 2
 Client secret: hLG9OZklbu3LHYNarOOdLPgm8UxLNw7ErH7NhyZw
 ```
 
<br>
<br>
<br>

## Links e Testes
- Autenticação API: 
    - Para Autenticar a API Utilize a Segunda Senha gerada ("Password grant client.")
    - Link: http://localhost:8000/api/v1/oauth/token (POST)
    - Corpo:
    ```
    {
    	"grant_type" : "password",
    	"client_id" : "SEGUNDO_ID_GERADO_PELO_COMMAND 'php artisan passport:install'",
    	"client_secret": "SEGUNDA_SENHA_GERADA_PELO_COMMAND 'php artisan passport:install'", 
    	"username" : "USUARIO_PREVIAMENTE_CADASTRADO_NO_SISTEMA",
    	"password" : "SENHA_DO_USUARIO_PREVIAMENTE_CADASTRADO_NO_SISTEMA"
    }
    ```
    - Exemplo Corpo
    ```
    {
    	"grant_type" : "password",
    	"client_id" : 2,
    	"client_secret": "hLG9OZklbu3LHYNarOOdLPgm8UxLNw7ErH7NhyZw", 
    	"username" : "user@veus.com.br",
    	"password" : "Veus1234"
    }
    ```
- Autenticação Web:
    - Link para Views: http://localhost:8000


## Bibliotecas Utilizadas

[Laravel](https://github.com/laravel/laravel)  
[Laravel Passport](https://github.com/laravel/passport)  
[laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization)

## Licença

Software licensed under the [MIT license](https://opensource.org/licenses/MIT).
