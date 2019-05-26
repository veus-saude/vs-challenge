## Comandos de execução
```
cd api
docker run --rm -v $(pwd):/app prooph/composer:7.2 install
cp .env.example .env
docker-compose up -d
```

Endereço para acessar a aplicação: http://localhost/

## Endpoints
```
POST   | api/v1/users
POST   | api/v1/users/auth
GET    | api/v1/products            
GET    | api/v1/products/{id}
POST   | api/v1/products            
PUT    | api/v1/products/{id}
DELETE | api/v1/products/{id}
```

## Swagger Authorization
Crie um usuário `POST api/v1/users`
Crie um token para esse usuário `POST api/v1/users/auth`
Copie e cole o token gerado em `Available authorizations` (abrir popup clicando em `Authorize`) no campo `value`

## Unit Test
Relatório de Testes pode ser consultado em: vs-challenge/api/report/html/index.html
```
./vendor/bin/phpunit
```