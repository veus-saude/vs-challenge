<h2>Documentação do Sistema</h2>
<p>Para instalação so sistema baixa editar os arquivos <b>conexao.php</b> e <b>seguranca.php</b> que estão dentro da pasta <b>sistema</b> e neles colocar as diretivas do banco de dados.</p>


<h2>Documentação API Versão 1</h2>
<p><b>Endereço da API:</b> http://example.com.br/api/v1/produtos.php </p>


<table id="datatable" class="table table-striped table-bordered">
          <thead>
          <tr>
              <th>Parâmetro</th>
    <th>Tipo</th>
    <th>Obrigatório</th>
    <th>Descrição</th>
            </tr>
          </thead>
          <tbody>
  <tr>
    <td>token</td>
    <td>string</td>
    <td>Sim</td>
    <td>Token criado automaticamente ao cadastrar um usuário no sistema, serve para autenticar o usuário da API.</td>
  </tr>
  <tr>
    <td>q</td>
    <td>string</td>
    <td>Não</td>
    <td>Parâmetro para pesquisa do produto pelo seu nome.</td>
  </tr>
  <tr>
    <td>brand</td>
    <td>int</td>
    <td>Não</td>
    <td>Parâmetro para pesquisa do produto pela marca (Colocar o ID Primário da marca cadastrada).</td>
  </tr>
  <tr>
    <td>sort</td>
    <td>string</td>
    <td>Não</td>
    <td>Parâmetro para ordenar os produtos - Opções: nome(Nome do produto), qtd(Quantidade em estoque), preco(Preço do Produto). O Default é a opção nome.</td>
  </tr>		
  <tr>
    <td>limit</td>
    <td>int</td>
    <td>Não</td>
    <td>Parâmetro para limitar a quantidade de produtos exibidos por página. O Default são 10.</td>
  </tr>
  <tr>
    <td>pg</td>
    <td>int</td>
    <td>Não</td>
    <td>Parâmetro para informar a página de produtos a ser exibida. O Default é 1.</td>
  </tr>					
  </tbody>
</table>

<h3>Exemplo de Consulta Completa</h3>
<p>
http://example.com.br/api/v1/produtos.php?token=1de99d8209f1eaf3&q=Teste&brand=2&sort=nome&limit=10&pg=1
</p>
