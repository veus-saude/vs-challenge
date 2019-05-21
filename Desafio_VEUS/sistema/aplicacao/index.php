<?php session_start();
//error_reporting(E_ALL);
//ini_set('display_errors','1');
?>
<!DOCTYPE html>
<?php 
	
	require("../include/seguranca.php");
	require_once('../classes/banco.class.php');
	require_once('../classes/paginacao.en.class.php');
   
	if(isset($_REQUEST['retorno']))
		$retorno = $_REQUEST['retorno'];
	
	
	// if ($retorno == 'INS_OK')
	// {
		// $MENSAGEM_RETORNO = $FORM_NAME.' adicionado com sucesso!';
		// $MENSAGEM_COLOR = 'success';
	// }
	

	class MyPag extends Paginacao
	{
		function desenhacabeca($row)
		{
		 	 $html = '
			        <thead>
					 <tr valign="top" class="tab_bg_2"> 
                      <th width="1%"> <input type="checkbox" name="tudo" onclick="verificaStatus(this)" />  </th>
					  <th width="5%">idproduto</th>
					  <th width="25%">Nome</th>
                      <th width="25%">Marca</th>					  
					  <th width="10%">Preço</th>
					  <th width="10%">Quantidade</th>
                           
                      </tr>
					  </thead>
                      ';
		 		echo $html;
		}

		function desenha($row){
					
			//converte datas
			//$datacriacao = date('d/m/Y',strtotime($row['datacriação']));
		
					
			$html = ' 
					<td align="center"><input type="checkbox" name="id_[]" id="id_" value="'.$row['idproduto'].'" /></td>					
					<td nowrap>'.$row['idproduto'].'</a></td>					
					<td nowrap>'.$row['nome'].'</a></td>					
					<td nowrap>'.$row['marca'].'</td>
					<td nowrap> R$ '.$row['preco'].'</td>
					<td nowrap>'.$row['quantidade'].'</td> 
					
					  
					  ';
		 		echo $html;
				echo "";
		}// function
	}
	
    $clConexao = new Conexao;
	$conn = $clConexao->conecta();
	
	$paginacao = new MyPag();
	$paginacao->conn = $conn;
	
	
	$nome=null;
	$filtro=null;
	
	if(isset($_REQUEST['q']))
		$nome = $_REQUEST['q'];
	if(isset($_REQUEST['filter']))
		$filtro = $_REQUEST['filter'];
	
	if(strpos($filtro, ':'))
		list ($campo, $valor) = explode(':',$filtro);


	$sql = "SELECT * FROM produto ";	
	

	if (!empty($campo) && !empty($valor))
		$sqlfilter1 = " LOWER($campo) LIKE LOWER('%".$valor."%') ";
	
	if (!empty($nome))
		$sqlfilter2 = " LOWER(nome) like LOWER('%".$nome."%') ";
	
	if(!empty($sqlfilter1) && empty($sqlfilter2))
		$sql .= ' where '.$sqlfilter1;
	elseif(empty($sqlfilter1) && !empty($sqlfilter2))
		$sql .= ' where '.$sqlfilter2;
	elseif(!empty($sqlfilter1) && !empty($sqlfilter1))
		$sql .= ' where '.$sqlfilter1.' and '.$sqlfilter2;	
		
	if(empty($filtro))
		$filtro = 'marca:';
	
	if(empty($cmboxordenacao)){
		$sql.= " order by idproduto ";
	}
	

	$paginacao->sql = $sql; // a sele
	$paginacao->filtro = ''; // o filtro a ser aplicado ao sql/
	if(isset($_REQUEST['nr']))
		$paginacao->numero_linhas = $_REQUEST['nr']; // quantidade de linhas por 
	$paginacao->mostra_informe = 'T';//
	if(isset($_REQUEST['p']))
		$paginacao->pagina = $_REQUEST['p'];
?> 
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>Consultar Produtos </title>
<!-- Icone titulo site -->
<link rel="icon" type="image/png" href="../img/logoicone.png" />

<link href="../css/bootstrap.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../css/sb-admin.css" rel="stylesheet">


<!-- Custom Fonts -->
<link href="../font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet" type="text/css">

	<!--Marca todos no Checkbox... -->
	<script src="../js/checkbox.js"> </script>
</head>

<body>
<div id="myModal" class="modal fade">
  <div class="modal-dialog"> 
    <div class="modal-content"> 
      <!-- dialog body -->
      <div class="modal-body"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Excluir todos o(s) registros(s)? </div>
      <!-- dialog buttons -->
      <div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger" onClick="excluir()">Excluir</button>
      </div>
    </div>
  </div>
</div>
    <div id="page-wrapper">
		  <?php require("topo.php");?>
       <div id="page-wrapper">

     <div class="row"> 
      <div class="col-lg-12"> 
        <div class="panel panel-default"> 
          <form action="index.php" name="frm" id="frm" method="post">
            <div class="panel-heading"> 
              <div class="row"> 
                    <div class="col-lg-4"> 
                      <div class="input-group input-group-sm"> <span class="input-group-addon">Nome</span> 
                        <input type="text" class="form-control"  name="q" id="q" value="<?php echo $nome;?>">
                      </div>
                    </div>
					<div class="col-lg-4"> 
                      <div class="input-group input-group-sm"> <span class="input-group-addon">Marca</span> 
                        <input type="text" class="form-control"  name="filter" id="filter" value="<?php echo $filtro;?>">
                      </div>
                    </div>
					
					  <div class="btn-group"> 
                        <button type="button" class="btn btn-success" onClick="filterApply();"> 
                        <span class="glyphicon glyphicon-ok-circle"></span> Filtrar 
                        </button>
                        <button type="button" class="btn btn-danger" onClick="removeFilter();"> 
                        <span class="glyphicon glyphicon-remove-circle"></span> 
                        Limpar</button>
                      </div>
					
                  </div>
            </div>
           
            <!-- /.panel-heading -->
            <div class="panel-body"> 
              <div style="overflow:auto;"> 
                <div class="table-responsive"> 
                  <?php $paginacao->paginar();?>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
          </form>
          <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
      </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
	</div>
   <!-- /#wrapper --> 

<!-- jQuery Version 1.11.0 --> 
<script src="../js/jquery-1.11.0.js"></script> 

<script type="text/javascript" charset="utf-8">

	function removeFilter()
	{
		window.location.href = 'index.php';
	}
	
	function filterApply()
	{
		document.getElementById('frm').action='index.php';
    	document.getElementById('frm').submit();
	}

	function montapaginacao(p,nr)
	{
		document.getElementById('frm').action='index.php?p='+p+'&nr='+nr;
    	document.getElementById('frm').submit();
	}
	

</script>

<!-- Bootstrap Core JavaScript --> 
<script src="../js/bootstrap.min.js"></script> 



</body>

</html>
