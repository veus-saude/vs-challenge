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
						
						
		<form method="post" enctype="multipart/form-data" target="_self" class="form-add-marca">
                

                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Cadastro de Marcas</h3>
                                </div>
                                <div class="panel-body">



             <div class="col-md-12">
              <div class="form-group">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control" placeholder="Marca" id="marca" required="required" />         
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
                                    <h3 class="panel-title">Marcas</h3>
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

<script type="text/javascript">
    $(document).ready(function () {
	
	$('.table-responsive').load('exibir_marcas.php');
		

	$(document).on("submit", ".form-add-marca", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'add_marca.php', /* URL que ser? chamada */ 
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
                text: "Marca adicionada com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   		   
			
		   $('.table-responsive').load('exibir_marcas.php');	
				
				
				}
				}
           });   
		   return false;
	});			
		

	$(document).on("submit", ".form-atualizar-marca", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'atualizar_marca.php', /* URL que ser? chamada */ 
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
                text: "Marca atualizada com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   
			
		   $('.table-responsive').load('exibir_marcas.php');

		   $('#pop_edita_'+data.id_marca).modal('hide');
				
				
				}
				}
           });   
		   return false;
	});			
	
	

	$(document).on("submit", ".form-delete-marca", function(evt) {
	var dados = new FormData(this);
           $.ajax({
                url : 'delete_marca.php', /* URL que ser? chamada */ 
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
                text: "Marca excluida com sucesso!",
                confirmButtonClass: 'btn-warning',
				timer: 2000
            });				 
		   
			
		   $('.table-responsive').load('exibir_marcas.php');

		   $('#pop_excluir_'+data.id_marca).modal('hide');
				
				
				}
				}
           });   
		   return false;
	});				
				
		
    });
</script>		
    
    </body>
</html>