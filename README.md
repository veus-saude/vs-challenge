### Teste de Produtos

Desenvolvido por [santoscaio](http://santoscaio.com).

# Escopo
Implementar uma API de manutenção e busca de produtos que atenda aos seguintes requisitos técnicos e de negócios:
- Use PHP > 7;
- e-commerce de produtos para laboratórios e hospitais;
- O cliente deve conseguir buscar pelos campos diponiveis;
- O cadastro de produtos possuir telas de CRUD de produtos;
- A API deve requerer autenticação;
- A API deve permitir search query através do método GET;
- A API deve suportar filtros opcionais nos campos do produtoT;
- A API também deve suportar pagination, versioning e sorting;</p>


# Pré Requisitos
- Versão do PHP maior que 7.
- É necessário possuir um banco de dados MySQL com um usuário com permissão de criação de tabelas, selecionar e atualizar.
- É necessário ter o Composer instalado para executar.
- Executar o comando "composer update na pasta ./api".
- Criar Schema do banco de dados com a "CREATE SCHEMA veus_sc_produto DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;".
- Se estiver usando o Linux dar permissão de leitura na pasta "./api/app/config" para criação da conexão ao banco de dados.


# Usos da API
- Para recuperar produto(s) utilizando paginação enviar a requisição GET para "api/v1/products?page=1&limit=2"
- Para recuperar produto(s) utilizando busca GET para "api/v1/products?q=seringa"
- Para recuperar produto(s) utilizando busca com filtro GET para "api/v1/products?q=seringa&filter=brand:BUNZL"
- Para recuperar produto(s) utilizando ordenação GET para "api/v1/products?order=LOWER(brand)%20ASC"
- Para recuperar produto por id GET para "api/v1/products?id=1"
- Para criar um produto utilizar PUT na "api/v1/products"
- Para atualizar produto utilizar POST na "api/v1/products"
- Para deletar produto utilizar DELETE na "api/v1/products/1"