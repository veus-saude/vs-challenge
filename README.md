<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre o Desafio

 O desafio foi feito com o framework **Laravel** não foi utilizado banco de dados, toda a massa de dados foi mocada em um formato NOSQL(JSON), apos fazer o download do projeto digite os seguites comandos: `php composer install`  esse comando irá instalar todas as dependencias do projeto, após isso suba o projeto com o comando: `php artisan serve`. agora e so debugar!

## Estrutura do projeto

A estrutura foi montada em cima do padrão MVC do laravel.
<br>
    **Controller:**
        Foram criados três metodos **index**, **ValidarParametro** e **busca**. Index esse metodo tem por finalidade gerenciar todo o processo desde a entrada dos dados ate o retorno do mesmo.
        <br>
        ValidarParametro esse metodo valida toda a entrada de parametros, caso um parametro venha em um formato não conforme com o padrão do sistema ele retornará um erro com o codigo 412!
        <br>
        **busca:** filtra os dados que vem da model passando os parametros e exibindo os resultados. 
        **Model:** a camada model ela filtra ela passa os parametros e exibe o resultado em uma array e verifica se os dados e os parametros estao corretos.
        **View:** esta pegando os dados e exibindo em um tabela os resuldatos consumindo atraves do javascript.
        **Middleware:** responsavel por checar as rotas e da permissao de acesso e retorna um erro 401 quando nao tem permissao no header de acesso **observação:** a view é a unica rota que passa pelo middleware sem checar o token.


---

