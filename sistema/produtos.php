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
						
						
		<form method="post" enctype="multipart/form-data" target="_self" class="form-add-produto">
                

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Cadastro de Produtos</h3>
                                </div>
                                <div class="panel-body">



             <div class="col-md-6">
              <div class="form-group">
                <label>Marca</label>
                <select name="id_marca" id="id_marca" class="form-control">
					<option value="" selected>Selecione</option>
					<?php
					$sql_marcas = $sqli->query("SELECT * FROM marcas ORDER BY marca ASC");
					while($row_marcas = $sql_marcas->fetch_assoc()) {
					?>
					<option value="<?php echo $row_marcas['id'] ?>"><?php echo $row_marcas['marca'] ?></option>
					<?php
					}
					?>
				</select>
              </div>
            </div>
								

             <div class="col-md-6">
              <div class="form-group">
                <label>Produto</label>
                <input type="text" name="nome" class="form-control" placeholder="Produto" id="nome" required="required" />         
              </div>
            </div>
			
             <div class="col-md-6">
              <div class="form-group">
                <label>Preço</label>
                <input type="text" name="preco" class="form-control" placeholder="Preço (Preencher valores sem vírgula e pontos)" id="preco" required="required" onKeyPress="FormataValor(this.id, 10, event)" />         
              </div>
            </div>

             <div class="col-md-6">
              <div class="form-group">
                <label>Qtd em Estoque</label>
                <input type="number" name="qtd" class="form-control" placeholder="Qtd em Estoque" id="qtd" required="required" />         
              </div>
            </div>			



                                </div>
                                
					<div class="panel-footer">
					<div class="row">
					<div class="col-md-12">
					   <button type="submit" class="btn btn-warning pull-right"><span class="fa fa-plus"></span> Adicionar</button>
				    </div>
					</div>
					</div>

                                
                            </div>


				</form>		




				<div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Produtos</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        
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
		
		<script src="js/valor.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
	
	$('.table-responsive').load('exibir_produtos.php');
		

	$(document).on("submit", ".form-add-produto", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'add_produto.php', /* URL que ser? chamada */ 
                type : 'POST', /* Tipo da requisi??o */ 
				data: dados,
				dataType: 'json',
				processData: false,
				cache: false,
				contentType: false,
				success: function(data){
				if(data.sucesso == 1) {	
				
	   
				 
            swal({
                title: "Cadastro Realizado!",
                text: "Produto adicionado com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   		   
		   $('.form-add-produto')[0].reset();				   
			
		   $('.table-responsive').load('exibir_produtos.php');	
				
				
				}
				}
           });   
		   return false;
	});			
		

	$(document).on("submit", ".form-atualizar-produto", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'atualizar_produto.php', /* URL que ser? chamada */ 
                type : 'POST', /* Tipo da requisi??o */ 
				data: dados,
				dataType: 'json',
				processData: false,
				cache: false,
				contentType: false,
				success: function(data){
				if(data.sucesso == 1) {	
				 
				 
				 
            swal({
                title: "Alteração Realizada!",
                text: "Produto atualizado com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   
			
		   $('.table-responsive').load('exibir_produtos.php');

		   $('#pop_edita_'+data.id_produto).modal('hide');
				
				
				}
				}
           });   
		   return false;
	});			
	
	

	$(document).on("submit", ".form-delete-produto", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'delete_produto.php', /* URL que ser? chamada */ 
                type : 'POST', /* Tipo da requisi??o */ 
				data: dados,
				dataType: 'json',
				processData: false,
				cache: false,
				contentType: false,
				success: function(data){
				if(data.sucesso == 1) {	
				 
				 
				 
            swal({
                title: "Exclusão Realizada!",
                text: "Produto excluido com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   
			
		   $('.table-responsive').load('exibir_produtos.php');

		   $('#pop_excluir_'+data.id_produto).modal('hide');
				
				
				}
				}
           });   
		   return false;
	});				
				
		
    });
</script>		
    
    </body>
</html>