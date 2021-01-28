## Teste Veus

Segue uma pequena documentação com os conceitos básicos da API:

- Para acessar a API é necessário, inicialmente, rodar as migrations e as seeds previamente construídas;
- Para autenticar é necessário utilizar um dos e-mails gerados automaticamente pelo processo de seeding do Laravel. A senha padrão é "password";
- Caminho para autenticação na API: "http://127.0.0.1:8000/api/v1/auth/login"
- Para consultar todos os produtos, basta acessar o caminho "http://127.0.0.1:8000/api/v1/produtos";
- A API permite que seja realizada uma busca utilizando os campos "nome" e "marca". Portanto, basta utilizar o prefixo filter[nome] ou filter[marca] e incluir o termo a ser localizado. Exemplo: "http://127.0.0.1:8000/api/v1/produtos?filter[nome]=camisa"
- Para ordenar o resultado, basta incluir o parâmetro sort. Exemplo: "http://127.0.0.1:8000/api/v1/produtos?sort=nome"
- Os resultados estão paginados.