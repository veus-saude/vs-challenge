
# Tutorial para levantar Desafio Veus do Bruno Arruda

## Siga os passos

### 1 Faça o download do projeto em seu console

```git clone https://github.com/brunowolly/veus.git```

### 2 Acesse o diretório do projeto

```cd veus```

### 3 instale e faça update das dependencias

```bash
composer install --no-dev
composer update --no-dev
```

### 4 Em seguida, utilize a imagem do composer para montar os diretórios que você precisará para seu projeto Laravel e evite os custos de instalar o Composer globalmente

```docker run --rm -v $(pwd):/app composer install```

Observação:os comandos que estiverem com caminho ~/veus devem ser adaptados para sua pasta local

### 5 Como passo final, defina as permissões no diretório do projeto para que ele seja propriedade do seu usuário não root

```sudo chown -R $USER:$USER ~/veus```

### 6 Crie seu arquivo .env com o comando nano em seguida, copie o conteúdo 
```nano .env```
``` bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=veus
DB_USERNAME=veus
DB_PASSWORD=veus

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### 7 inciando os containers, criando volumes e conectando as resdes configuradas no docker-compose.yml e Dockerfile

```docker-compose up -d```

### 8 você poderá listar os containers criados com o comando abaixo

```docker ps```

### 9 Gerar a chave para o aplicativo Laravel

```docker-compose exec app php artisan key:generate```

### 10 coloque as configuções em cache para aumentar a velocidade de carregamento do aplicativo

```docker-compose exec app php artisan config:cache```

### 11 crie seu usuário MySql

```docker-compose exec db bash```

### 12 Agora, dentro do container, faça o login na conta root, ao solicitar a senha, utilize veus

```mysql -u root -p```

### 13 execute

```sql
GRANT ALL ON veus.* TO 'veus'@'%' IDENTIFIED BY 'veus';
FLUSH PRIVILEGES;
EXIT;
```

### 14 por fim, saia do container

```exit```

### 15 Agora, precisamos executar o migrate do laravel para criar as tabelas

```docker-compose exec app php artisan migrate```

### 16 Vamos criar o primeiro usuário e alguns produtos
```
docker-compose exec app composer dumpautoload
docker-compose exec app php artisan db:seed
```

Observação:
Será criado usuário Bruno, com email=brunowolly@gmail.com e password=senha123. Você precisará disso para gerar token que permitirá acessar a api.

### 17 Gerar nossa chave para jwt

```docker-compose exec app php artisan jwt:secret```

### 18 Acessar Postman ou aplicativo de testes de api de sua preferência

### 19 Acessar a URL
```localhost:8081/api/auth/login```

### 20 no boddy, é preciso passar o email e password definidos na criação do usuário
Faça a requisição

O retorno será um json parecido com este, copie o conteúdo do campo "access_token"
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MVwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4MjM0OTgyMywiZXhwIjoxNTgyMzUzNDIzLCJuYmYiOjE1ODIzNDk4MjMsImp0aSI6IkFMRktheWN1MzRsYzJkYTUiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.Ka2VTnmGs_vimvMVB_AKmWZDASjb8R1m8846__Lf7po",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### 21 abra uma nova aba para efetuar requisiçes da api

é necessáiro escolher "Authorization", selecionaro Type como "Bearer Token", cole o conteúdo do access_token no campo token

### 22 As ROTAS

```
GET    - http://localhost:[porta]/api/v1/products/
GET    - http://localhost:[porta]/api/v1/products/{id}
POST   - http://localhost:[porta]/api/v1/products/
PUT    - http://localhost:[porta]/api/v1/products/{id}
DELETE - http://localhost:[porta]/api/v1/products/{id}

GET localhost:8081/api/v2/teste

```

## 23 Cadastrando um novo produto

Tenha certeza de estar com TOKEN (passos 19, 20 e 21)  
Os parâmetros para cadastro do produto são: name, price, amount e brand  
POST - http://localhost:8081/api/v1/products?name=Gaze Top&price=1.3&amount=10&brand=B.BRAUN  


### 24 Sorting

http://localhost:[porta]/api/v1/products/?sort=price,DESC  
Obs: sort:campo,TIPO  
Tipo pode ser: ASC ou DESC. Caso esse parâmetro seja omitido, a ordenação será ASC.  

### 25 Total Itens Por Página

http://localhost:[porta]/api/v1/products/?p=2

### 26 Query Builder

http://localhost:[porta]/api/v1/products/?q=B

### 27 É possível combinar os parâmetros de Total por página, Sorting e Query Builder

http://localhost:[porta]/api/v1/products/?q=B&sort=price,ASC&p=2

### 28  Filtro

url/?filter=campo:condição:valor  
campo = Pode ser qualquer campo da tabela products (id, name, price, amount, brand)  
condição = LIKE, IN, =, >, <,  <>, >=, <=  
valor = qualquer valor possível para o campo  
  
caso o filtro no satisfaça alguma das condições (3 parâmetros), ele sera ignorado.  

Exemplo de filtro  
Buncando registros onde a marca possua B no nome   
localhost:8081/api/v1/products/?filter=brand:LIKE:B

Buncando registros que possuem estoque maior que 5  
localhost:8081/api/v1/products/?filter=amount:>:5  


### 29  Pagination

Feita automaticamente por paginate() do Laravel

# PHPMyAdmin

Acesse via URL:http://localhost:8000/  
user:veus  
password: veus  

