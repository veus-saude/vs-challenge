<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página
?>
<?php
include "conexao.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Veus Technology - Área Administrativa</title>

		<link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">




            <?php include 'topo.php'; ?>



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->


                        <div style="min-height: 1000px;">




                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Documentação API</h3>
                                </div>
                                <div class="panel-body">


                                    <div class="table-responsive">

			<div class="col-md-12" style="padding-bottom:25px;">
			<h2>Documentação API Versão 1</h2>
      <p>Os dados retornados pela API estão em formato JSON.</p>
			<p><b>Endereço da API:</b> http://srv98.teste.website/~veusteccom/api/v1/produtos.php </p>
			</div>



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


			<div class="col-md-12" style="padding-top:25px;">
			<h3>Exemplo de Consulta Completa</h3>
			<p>
			http://srv98.teste.website/~veusteccom/api/v1/produtos.php?token=1de99d8209f1eaf3&q=Teste&brand=2&sort=nome&limit=10&pg=1
			</p>
			</div>

                                    </div>



                                </div>

                            </div>






				<div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Consultar API</h3>
                                </div>
                                <div class="panel-body">

             <div class="col-md-12">
              <div class="form-group">
                <label>Endereço (GET)</label>
                <input type="text" name="endereco" class="form-control" placeholder="Endereço (GET)" id="endereco" required="required" />
              </div>
            </div>

					<div class="col-md-12">
					   <button type="button" id="cns-api" class="btn btn-warning pull-right"><span class="fa fa-search"></span> Consulta</button>
				    </div>


                                    <div class="col-md-12" id="resultado_api" style="padding:10px; background:#efefef; border:1px solid #ccc; border-radius:5px; margin-top: 10px; height:300px; overflow-y:auto;">

                                    </div>
                                </div>
                            </div>



						</div>



                    </div> <!-- container -->

                </div> <!-- content -->



			<?php include 'rodape.php'; ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

	$('#cns-api').click(function() {
		var endereco = $('#endereco').val();
		if(endereco != '') { $('#resultado_api').load(endereco); }
	});


    });
</script>

    </body>
</html>
