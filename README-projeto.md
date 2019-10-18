# Como levantar o projeto

É necessário ter o `docker` e o `docker-compose` na sua máquina.

**Clone do projeto**
`$ git clone https://github.com/heliortf/vs-challenge.git`

**Entre na pasta do Projeto**
`$ cd vs-challenge/veus`

**Copie o arquivo de configuração do projeto**
`$ cp -p .env.example .env`

**Levante os serviços**
`$ docker-compose up -d --build`

Ao levantar os serviços, o apache vai instalar as dependencias do projeto via composer e depois vai rodar os migrations e seed do Laravel.

Então a principio o projeto só estará 100% levantado quando terminar os processos no container do apache ( isso depende da sua conexão com a internet ).

## Requisitos

### Versionamento
Foi adicionado o `nginx` como load balancer para rotear o acesso para a `versão 1` ou a futura `versão 2` do projeto, assim poderíamos ter outros containers do projeto por versão funcionando em paralelo.

Veja as configurações do nginx em:
`/veus/docker/nginx-gateway.conf`

### Ordenação e Filtro
Para facilitar os testes manuais do projeto foi adicionada uma `collection do postman` com todas as rotas da API na versão 1. As rotas também funcionam com o prefixo `/v2`, mas está apontando para a mesma api `/v1`.

Você pode importar essa collection e testar a API.

### Testes unitários
Também foram incluídos testes unitários para as rotas do controller fazendo validações nas funcionalidades.

Para rodar os testes unitários é necessário rodar o comando no container do apache usando o docker.

Após o serviço levantado e funcionando, rode o comando abaixo para rodar os testes no container do apache:

`$ docker exec -it veus-apache composer run test`

O composer.json do Laravel está configurado para rodar o testsuite de Produtos.