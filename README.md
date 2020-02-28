
![enter image description here](https://camo.githubusercontent.com/d3e1b9d696e728186fb2d30923e87483272671ae/68747470733a2f2f692e696d6775722e636f6d2f324c55523279792e706e67)

Abaixo segue o passo a passo de como subir o servidor para testar o projeto, o projeto foi dividido em duas partes, primeiro vem a **API(backend)** e em seguida a aplicação **Client (frontend)**. A aplicação front-end esta inacabada, porém a aplicação **client** não esta completa, mas deixarei a aplicação no repositório para ser analisado o Designer e usabilidade.


# Requerimentos
O servidor da aplicação foi desenvolvido totalmente em **docker** necessitado somente uma instalação docker na máquina. 

Desenvolvi uma imagem para o docker especialmente para este desafio, sem uso de quaisquer recursos de terceiros, exceto na imagem de bando de dados.

Seque abaixo o link do **Dockerfile** para análize:
[Dockerfile](https://github.com/damiaojuniort/docker-web-laravel) e a imagem Docker hospedada no **Docker Hub** [Docker Image](https://hub.docker.com/r/damiaojuniorterto/veus-challenge-laravel).

## Iniciando Servidor

Antes de tudo configure o banco de dados no arquivo **.env** com as seguintes configurações:

    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=veusdb
    DB_USERNAME=postgres
    DB_PASSWORD=pgsql


Para subir os servidores da **aplicação(backend)** e  **banco de dados**, na raiz do projeto execute o comando abaixo:

    docker-compose -f "docker-compose.yml" up -d --build
    
  Após a conclusão do **build** dos containers, abra um **bash interativo**  no container relacionado a aplicação **backend** e execute  a instalação das migrations com o comando abaixo:

    php artisan migrate

Gere uma chave criptográfica para a aplicação com o comando:

    php artisan key:generate
E gere outra chave secreta para a autenticação JWT da API com o comando:

    php artisan jwt:secret

Após todo esse procedimento basta acessar http://localhost.


## Aplicação Client


```

yarn install

```

  

### Compiles and hot-reloads for development

```

yarn serve

```

  

### Compiles and minifies for production

```

yarn build

```

  

### Lints and fixes files

```

yarn lint

```

  

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).