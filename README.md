## Release Notes

- **Executar o comando composer update**
- **Executar o comando php artisan migrate**
- **Executar o comando php artisan db:seed (irá popular a tabela de produtos)**
- **executar o comando php artisan passport:install --force**
- **Executar apache**
- **Criar usuário usando a seguinte requisição http://localhost:8000/api/auth/registro e efetuar um POST passando os seguintes parametros via json**

{
  "name"  	  : "Teste de pessoa",
  "email"     : "teste@teste.com.br",
  "password"  : "teste123",
  "password_confirmation"  : "teste123"
}

**-Efetuar o login para pegar o token de acesso http://localhost:8000/api/auth/login**
{
  "email": "teste@teste.com.br",
  "password": "teste123"
}

**Utilize o token retornado no passo anterior para fazer as buscas através da url http://localhost:8000/api/v1/products?q=m&filter=brand:commodi**
