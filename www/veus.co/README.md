
# Teste de conhecimentos Veus

## Notas da Versão:

* Para atender ao enunciado da atividade decidi usar o passport biblioteca de autenticação para api em Laravel.
*  Usei um esboço de store em react para ser a página principal. Está longe do ideal mas serve pra ilustrar e também mostra alguma noção de react, redux e outras bibliotecas.
*  Criei 2 arquivos de controller um como versão v0 da api para a servir ao propósito de carregar do dados de aplicação react e atender ao pré-requisito de versionamento de api.
*  Criei também uma pequena área adminstrativa para editar usuários e produtos via browser.
*  Ia criar um middleware para controlar o acesso à adminstração verificando o status do usuário. Mas devido ao tempo e a necessidade de enviar a avaliação. Resolvi não implementar estas e outras melhorias.
  


## Pré-requisitos
#### adicionar ao arquivo de hosts os seguintes mapeamentos
#### 127.0.0.1 veus.co
#### 127.0.0.1 mysql
#### php7 instalado localmente

&nbsp;

&nbsp; 

&nbsp;


## Passos para execução
&nbsp;
### ** Atividade 1 - obter bibliotecas da aplicação (executar à partir da pasta www\veus.co)**
&nbsp;
### Execute os comandos abaixo na ordem proposta
``` $ composer install ```

&nbsp;
``` $ npm install && npm run prod ```

&nbsp;
``` $ php artisan migrate --seed ```

&nbsp;
#### Caso já exista arquivo no diretório veus\database execute: 
``` $ php artisan migrate:fresh --seed ```

### Regerar credenciais do passaport: 
``` $ php artisan passport:install --force  ```




### **Atividade 2 - Levantar o servidor docker (executar à partir da pasta raiz)**
$ docker-compose up -build -d

&nbsp;

### **Atividade 3: Acesse a url https://veus.co no seu browser e verificar o site é exibido.**

Foi criado um usuário admin com o seed da aplição e produtos também:

&nbsp;
chave | dado | Descrição
---|--- | ---
email | veus@veus.com.br | E-mail
password | veus2020@@ | senha do admin
&nbsp;

&nbsp;


# API 

UC001 - Criar Usuário via api

1. Usando postman faça uma requisição Post:


Rota | veus.co/api/v1/register 
---|----|

&nbsp;

&nbsp;

Parametros:
chave | Exemplo | Descrição
---|--- | ---
name | alessandro | Nome do usuário
email | alessrio@gmail.com | E-mail
password | ******** | senha de 8 digitos
password_confirmation | ******** | repita o valor da senha

&nbsp;

&nbsp;

##API 

UC002 - Obter token bearer

1. Usando postman faça uma requisição de login:


Rota | veus.co/api/v1/login 
---|----|


Parametros:
chave | Exemplo | Descrição
---|--- | ---
email | alessrio@gmail.com | E-mail
password | ******** | senha mínima de 8 digitos



&nbsp;

>  Nota: O usuário precisa estar com status maior ou igual à 1 = Ativo

A aplicação vai retornar o access-token use esse token como autenticação bearer no Caso de uso 3 UC003.



&nbsp;


&nbsp;


UC003 - Crud Produtos via api

1. Usando postman faça uma requisição usando os verbos http (post,put ,delete etc):


Rota | veus.co/api/v1/products 
---|----|


Parametros:
chave | Exemplo | Descrição
---|--- | ---
name | Seringa | Nome do produto
brand | alessrio@gmail.com | Nome da marca ou fabricante
price | 1000.00 | preço do produto formato $$.$$
qty | 350 | quantidade formato $$$$

&nbsp;

&nbsp;

UC004 - Pesquisar ou filtrar Produtos via api

1. Usando postman faça uma requisição usando get para url principal:


Rota | veus.co/api/v1/products 
---|----|


Parametros:
chave | Exemplo | Descrição
---|--- | ---
name | Seringa | Nome do produto
q | seringa | termo à ser buscado
filter | BUNZL | marca a ser buscada 

