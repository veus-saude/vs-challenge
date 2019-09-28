## PHP Laravel API com CRUD em Angular 8

Exemplo de aplicação PHP utilizando API Restfull, autenticação JWT e framework Laravel, base de dados em mysql no backend, frontend em Angular 8,
testes unitários e ambiente docker.

## Instalação

1. Entre na pasta rais dos arquivos e execute `docker-compose up -d` para configurar os containers Docker;
2. Execute o comando `docker exec app_veus bash -c "/var/www/html/scripts/configure.sh"` para instalar as dependencias, migrations e efetuar o deploy da aplicação.
3. Identifique o ip do container com o comando `docker inspect app_veus"`;
4. Acesse o ip do container web no navegador.

## Como usar

A aplicação já terá vários produtos de simulação cadastrados e também um usuário padrão de login `veus@veus.com.br` e senha `123456`, contudo é possível se cadastrar novamente na interface do usuário.

Os testes poderão ser executados através do seguinte comando: `docker exec -it app_veus bash -c "/var/www/html/vendor/bin/phpunit --configuration /var/www/html/phpunit.xml"`.

Exemplos de utilização da API:

1. `api/products?filter=name:bisturi&filter=brand:ultramed`;
2. `api/products?sort=name:asc&filter=brand:ultramed`;
3. `api/products?sort=name:asc&per_page=10&page=2`;
4. `api/products?q=bisturi&sort=quantity:desc`.

A versão da api pode ser trocada utilizando o parâmetro Accept do cabeçalho HTTP HEADERS das seguintes formas:

1. `Accept: application/x.veus.v2+json`;
2. `Accept: application/x.veus.v1+json`;

Para testar acesse a URL api/version;
