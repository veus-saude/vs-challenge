## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

#### Dependências
- MySQL 5.7+
- Apache Server 2.4+
  - mod_rewrite
  - libapache2-mod-php
- PHP 7.0+
  - PHP-PDO
  - PHP-Common
- npm 3.5.2
  
#### Instalação
A instalação do sistema pode ser feita seguindo os seguintes passos:
> ATENÇÃO: Os passos para instalação descritos nesta documentação, assumem que a aplicação rodará em uma máquina Linux (preferencialmente Ubuntu 16.04 LTS) e que todas a dependências já foram instaladas e configuradas.

1. Clonar ou Baixar o projeto diretamente na `Home` de usuário
```bash
$ cd ~/
```
Caso você tenha optado por baixar o arquivo zipado da ultima versão, descompacte o mesmo e entre no diretório criado por este processo.
```bash
$ cd ~/desafio-veus
```
2. Configuração das credenciais de acesso ao Banco de Dados MySQL
O SGDB usado é o `MySQL`, e para que o sistema possa usá-lo, é necessário alterar algumas entradas no arquivo `.env`, de acordo com as suas credenciais de acesso.
Os valores que devem ser alterados são `servidor`, `usuario` e `senha`. Por exemplo, considerando que temos o seguinte cenário:
 - DB_HOST=127.0.0.1
 - DB_PORT=3306
 - DB_DATABASE=challenge_veus
 - DB_USERNAME=root
 - DB_PASSWORD=root
 
 então o arquivo `.env` ficaria da seguinte forma:
 
```bash
APP_NAME=Lumen
APP_ENV=local
APP_KEY=base64:xk/oGzgIEtNs1VeMdXzByc9juG4IkE4ulBOxD4fl4CU=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=challenge_veus
DB_USERNAME=webapp
DB_PASSWORD=webapp
DB_CHARSET=utf8
DB_COLLATION=utf8_unicode_ci

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```
#### Servidor Apache
Aqui você pode se basear em como configurar seu servidor HTTP, porém as configurações podem mudar entre versões e distribuições Linux. Aqui estamos tomando como base uma distribuição `Ubuntu 16.04 LTS`.
Primeiro deve ser habilitar o módulo `mod_rewrite`:
```bash
$ sudo a2enmod rewrite

```
3. Navegue até a pasta frontend
```bash
$ cd ~/desafio-veus/frontend/veus-frontend
```

4. Execute os seguintes comandos para iniciar a aplicação:
``` bash
# Instalar as dependências
npm install

# Servidor com hot reload executando em localhost:8081
npm run dev
```

#### Créditos
Esta aplicação foi desenvolvida por [Paulo Henrique Coelho Gaia](mailto:phcgaia11@yahoo.com.br).
