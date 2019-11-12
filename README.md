# Desafio VS

### Pré requisitos

* Laravel 5.8 e seus [requisitos](https://laravel.com/docs/5.8/installation#server-requirements)
* Composer

### Passos para instalação e configuração
Clonar o repositório com o comando:
```sh
$ git clone https://github.com/kaabsimas/vs-challenge.git
```
Instalar dependências via composer
```sh
$ composer install 
```
Gerar a chave da aplicação utilizando o artisan
```sh
$ php artisan key:generate
```
Configurar banco de dados para utilização editando os dados relevantes no arquivo .env e executar as migrations 
para criação da tabela products
```sh
$ php artisan migrate
```
   Opcionalmente inclua a flag --seed para preencher a tabela com dados aleatórios
```sh
$ php artisan migrate --seed
```

### Testando
Execute o servidor imbutido do Laravel para iniciar o teste mais rapidamente
```sh
$ php artisan serve
```
Utilizando uma ferramenta como Postman, Insomnia ou alguma linguagem de programação, faça chamadas HTTP para
```
htpp://localhost:8000/api/v1/product
```
Uma chamada GET irá retornar todos os registros em json

  #### Criação
  Envie dados com a seguinte extrutura para a URL da API com uma chamada POST
  ```
  {
    name:
    brand:
    price:
    store:
  }
  ```
  A resposta será um json do registro na tabela, com id e data de criação.
  
  #### Atualização
  Para alterar dados de um produto registrado, envie os dados a serem alterados via PATCH ou PUT para
  ```
  PATCH http://localhost:8000/api/v1/product/{id_produto}
  ```
  A resposta será um json do registro com os dados atualizados em caso de sucesso.
  
  #### Visualização
  Para retornar os dados de um registro específico, faça uma chamada GET com o id do produto na URI
  ```
  GET http://localhost:8000/api/v1/product/{id_produto}
  ```
  A resposta será um json do registro se ele existir e não tiver sido softdeleted, ou status 404 caso contrário.
  
  #### Busca
  Para pesquisar um produto ou conjunto pelo nome, faça uma chama GET com o parâmetro `q` via query string:
  ```
  GET http://localhost:8000/api/v1/product?q=seringa
  ```
  É realizada uma busca por expressão regular na coluna `name`
  Também é possivel filtrar marca, preço ou quantidade em estoque utilizando o parâmetro `filter` vie query string:
   ```
  GET http://localhost:8000/api/v1/product?filter=brand:johnsons
  ```
  
  #### Ordenação
  Para determinar a ordem dos resultados obtidos, utilize o parâmetro `order` via query string:
   ```
  GET http://localhost:8000/api/v1/product?order=price:desc
  ```
 
  #### Paginação
  Para paginar os resultados, deve-se fornecer o número da página deseja e o tamanho das páginas;
   ```
  GET http://localhost:8000/api/v1/product?page=3&size=5
  ```
  A chamada acima irá retornar cinco registros em formato json contados a partir do terceiro.
  
  ## PHPUnit
  Para rodar os testes automáticos, certifique-se de que os dados de acesso ao banco de dados estão preenchidos no arquivo .env e execute o seguinte comando:
```sh
$  ./vendor/phpunit/phpunit/phpunit
```
O resultado, caso não haja nenhum erro, é o seguinte:
```sh
PHPUnit 7.5.17 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 6.6 seconds, Memory: 22.00 MB

OK (6 tests, 31 assertions)
```
