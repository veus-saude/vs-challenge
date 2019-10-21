## Desafio VS

Foi desenvolvida uma API REST para buscar, cadastrar, editar e deletar produtos e marcas. O código foi feito utilizando o framework Yii 1.1.21, PHP 7.2.23 e MariaDB 10.4.8.

A autenticação da API foi feita através de token JWT, o qual é obtido através de um login e uma senha. O token gerado foi configurado para expirar em 120 segundos, para facilitar os testes do timeout.

Foi desenvolvida uma interface gráfica para testar as requisições para API, contendo 1 exemplo de cada tipo de requisição. Embora a API manipule os cadastros de produtos e marcas, a interface gráfica só foi implementada para a API dos produtos.

## Procedimentos para executar o projeto

Após ter clonado o projeto, você deve fazer o download do framework (https://github.com/yiisoft/yii/releases/download/1.1.21/yii-1.1.21.733ac5.zip) e descompactá-lo no mesmo nível onde o projeto foi clonado. Ao fazer isso, você deverá ficar com as duas pastas dessa forma, por exemplo: `/var/www/html/vs-challenge` e `/var/www/html/yii-1.1.21.733ac5`.

Depois disso, é necessário criar um banco de dados e importar o arquivo **database.sql** que se encontra na raíz do projeto.

Em seguida, altere as credenciais de acesso ao banco de dados no arquivo `api/v1/protected/config/database.php`.

Pronto! Feito isso, basta executar no navegador a URL da raíz do projeto.

Qualquer dúvida, favor entrar em contato comigo através do email: scjonatas@gmail.com

## Documentação da API

Para obter o token, é necessário enviar uma requisição POST com os parâmetros `{"login":"admin", "password":"admin"}` para a URL `api/v1/token/` (relativa à raíz do projeto). A API retornará um JSON no seguinte formato:

```javascript
{
    "status":"ok",
    "code":"200",
    "messages":[],
    "result":"<jwt-token>",
}
```

Todos os retornos da API seguem o mesmo formato acima. Os **status** possíveis são *ok* e *error* e os códigos de retorno (**code**) podem ser *200* ou *400*.

De posse do token, as requisições para os endpoints `api/v1/products` e `api/v1/brands` devem ser feitas passando o cabeçalho `Authorization: Bearer <jwt-token>`.

**Exemplo de requisição GET**
Exemplo apenas para ilustrar o uso de todos os parâmetros possíveis da requisição GET

```javascript
$.ajax({
	url: 'api/v1/products',
	headers: {
		'Authorization':'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NzE2MzI1ODYsImlzcyI6Imh0dHA6XC9cL2xv2FsaG9zdCIsImRhdGEiOnsibG9naW4iOiJhZG1pbiJ9fQ.4LuipnL3GOo5BK_JcBA8VH-j0DWGhhv8Z7P6e7F2glU'
	},
	type: 'GET',
	dataType: 'json',
	data: {
		"q":"destilador",
		"filter":["brand:marte","amount:>10","price:>=1000"],
        "sort_by":"name DESC",
        "page_size":"5",
        "page_number":"2",
	},
	success: function(response) {
		$('#output').val(JSON.stringify(response, null, 2));
	}
});
```

**Exemplo de cadastro de produto (POST)**

```javascript
$.ajax({
	url: 'api/v1/products',
	headers: {
		'Authorization':'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1NzE2MzI1ODYsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsImRhdGEiOnsibG9naW4iOiJhZG1pbiJ9fQ.4LuipnL3GOo5BK_JcBA8VH-j0DWGhhv8Z7P6e7F2glU'
	},
	type: 'POST',
	dataType: 'json',
	data: {
		"Product": {
            "name": "Teste",
            "idBrand": "1",
            "price": "10.40",
            "amount": "100",
	    }
	},
	success: function(response) {
		$('#output').val(JSON.stringify(response, null, 2));
	}
});
```
