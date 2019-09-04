# Desafio Veus
Feito por Lucas Maia - lucas.codemax@gmail.com

Celular: (21) 97545-5783

WhatsApp: (21) 96438-6937

Candidato a vaga de Programador PHP (Senior / Pleno)

> Neste desafio, desenvolvi a API solicitada em [Lumen (Micro-Framework do Laravel)](https://lumen.laravel.com/docs).
Na minha opinião, é o ideal para desenvolvimento de API / Webservice.

Soube por meio da Ligia, que vocês estavam à procura de um desenvolvedor PHP com experiência em Laravel.
Então caprichei para mostrar as minhas skills com este excelente Framework.

> A propósito, também trabalho com o VueJS, jQuery, CSS, HTML5, ótimas noções de design de interfaces / sites (Full-stack)

### Esclarecimentos iniciais
Não fiz a User interface (front-end de navegação do usuário, se entendi certo) no intuito de concluir o teste
mais rapido possível.

## Como levantar o ambiente e rodar a aplicação?

Após clonar o projeto, acesse o diretório raiz do projeto em si.

#### É hora de subir o Docker, então vamos ao Pull

`sudo docker-compose up -d`

O Dockerfile, vai cuidar do resto... 
> É um modelo pessoal, compatível com todos os recursos que trabalho / já trabalhei. Fiquem a vontade para copiar

Depois que o Docker pull terminar e subir todos os conteiners, segue a instalação normal de um projeto Laravel.

`composer install` 
> Acredito que não tenha nenhum pacote com extensões fora do comum.

Depois

`cp .env.example .env`

No seu arquivo hosts

`127.0.0.1 db` (Não creio que seja necessário, mas se o banco não conectar...) 

`php artisan migrate --seed` _Talvez precise dar permissão de escrita em "storage/"_

## Testando a API

A API estará disponível no endereço principal http://localhost/v1/.

**Autenticação**

Particularmente, uso JWT Token (Bearer Token) para previnir acessos mal intensionados / tentativas.
Também funciona bem em aplicações SPA.

## Endpoints

| HTTP  | Rota                      | Descrição                     | autenticação        |
| ----- | ------------------------- | ----------------------------- | ------------------- |
| POST	| /auth/user 				| Login	/ Autenticação			|                     |
| POST	| /auth/register			| Cadastra Usuário				|                     |
| GET	| /brands                 	| Lista todas as marcas			| JWT Token           |
| POST	| /brands/              	| Cadastrar uma marca			| JWT Token           |
| PUT	| /brands/{id}	            | Editar uma marca				| JWT Token           |
| DELETE| /brands/{id}	            | Remover uma marca				| JWT Token           |         
| GET	| /products                 | Lista todas os produtos		| JWT Token           |
| POST	| /products/              	| Cadastrar um produto			| JWT Token           |
| PUT	| /products/{id}	        | Editar um produto				| JWT Token           |
| DELETE| /products/{id}	        | Remover um produto			| JWT Token           |   

Não se preocupe, a validação vai pedir os campos que precisar inserir.

**Nos testes automáticos, estão comentados todos os testes e como deve funcionar corretamente.**
Inclusive outros meios de filtro de dados, etc.

## Executar os testes unitários

Na raiz do projeto, execute:

`vendor/bin/phpunit`

A resposta deve ser parecida com isso:

````
PHPUnit 7.5.15 by Sebastian Bergmann and contributors.
    
...............                                   15 / 15 (100%)
    
Time: 535 ms, Memory: 16.00 MB
    
OK (15 tests, 39 assertions)
````
### Considerações finais
Espero que gostem.

Estarei ancioso no feedback de vocês sobre esta oportunidade de fazer parte da equipe.
=)