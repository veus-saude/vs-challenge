<?php
class Paginacao
{
	var $conn;
    var $ID;
    var $sql; 
	var $filtro;
	var $order;
	var $numero_colunas = 1; 
	var $numero_linhas = 10; 
	var $quadro; 
	var $altura_linha = '20px'; 
	var $largura_coluna = '10px';
	var $tamanho_imagem = 0; 
	var $mostra_informe = 'T';//
	var $pagina ;
	var $separador;
	
	function desenha($row)
	{
	}
	
	function desenhacabeca($row)
	{
	}

	function pegaPaginaInicio($p,$total,$por_pagina)
	{
	   if ($total >10){
		  if ($p <= $por_pagina) {
			  $pag_inicio = 1;
			  if ($p > ($por_pagina / 2))
			  {
				 $pag_inicio = $pag_inicio;
			  }
		  }
		  else 
		  {
			  $pag_inicio = ceil($p/$por_pagina);
			  $pag_inicio = ($pag_inicio-1)*$por_pagina+1;
			  if ($p>=($pag_inicio+10))
			  {
				   $pag_inicio = $pag_inicio + 10;
			  }
		  }
	   }
	   else
	   {
	       $pag_inicio = 1;
	   }
	   return $pag_inicio;
	}

	function pegaInforme($p,$numero_por_paginas,$num_registros,$total_paginas)
	{
		
		
    	  $informe = " Mostrando ". (($p*$numero_por_paginas)-($numero_por_paginas-1))." - ".($p*$numero_por_paginas)." de ".$num_registros." em ".$total_paginas." Páginas";
		  return $informe;
	}

	function paginar()
	{
		$sql_ordem = null;
		
		  $p = $this->pagina;
		  if (empty($p))
		  {
		  	$p = 1;
		  }
	      $col = $this->numero_colunas;
       	  $row = $this->numero_linhas;
		  if (empty($row))
		  {
		  	$row=10;
		  }
		  $tam = $this->tamanho_imagem;
		  $sql = $this->sql;
		  $separador = $this->separador;
		  $t = $this->tamanho_imagem;
		  $o = $this->order;
		  $mostra_informe = $this->mostra_informe;
		  $result = mysqli_query($this->conn, $sql);
   		  $num_registros = $result->num_rows;
		  $numero_por_paginas=$row*$col;
		  $total_paginas = ceil($num_registros/$numero_por_paginas);
		  $pag_inicio = $this->pegaPaginaInicio($p,$total_paginas,$numero_por_paginas);
		  $sql .= $sql_ordem." limit ".$numero_por_paginas." offset ".($p-1)*$numero_por_paginas."";
		  $result = mysqli_query($this->conn, $sql);
		
   		  $informe = $this->pegaInforme($p,$numero_por_paginas,$num_registros,$total_paginas);
		?>  

		<table border="0" class="table table-striped table-bordered table-hover" >
		<tbody> 
			<?php
				$d = 0;
				$c=0;
				
				// print_r($row2);
				// exit;
				while ($row2 = $result->fetch_assoc())
				{
					// print_r($row2);
					// exit;
					
				   if ($d==0)
				   {
						$this->desenhacabeca($row2);
						$d++;
				   }
				   if ($c==0) {echo "<tr>";  }
				   $c++;
				   
				   $this->desenha($row2);
					 if ($c==$col) {$c=0; echo "</tr>";
					 if ($separador == 'T'){
					 ?>
					 <tr><td colspan="<?php echo $col;?>"><hr></td></tr>
					 <?php }
					 }
	
				} ?>
				 				
		</tbody>
		</table>

		<table align="center" width="100%" class="table">
          <tr> 
            <td align="left"><?php echo $informe;?></td>
            <td align="center">Mostrar <select name='nr' id='nr' onChange="montapaginacao(<?php echo $p;?>,this.value)">
		<option value="10" <?php if ($row=='10') echo "SELECTED";?>>10</option>
		<option value="20" <?php if ($row=='20') echo "SELECTED";?>>20</option>
		<option value="50" <?php if ($row=='50') echo "SELECTED";?>>50</option>
		<option value="100" <?php if ($row=='100') echo "SELECTED";?>>100</option>
		</select> Registros</td>
            <td align="right">
			<?php
			?>
			<a class="btn btn-default btn-xs" onClick="montapaginacao(<?php echo '1';?>,document.getElementById('nr').value)"><?php echo "Primeria";?></a>
			<?php if ($p!=1){
			?>
			<a class="btn btn-default btn-xs" onClick="montapaginacao(<?php echo $p-1;?>,document.getElementById('nr').value)"><?php echo "Anterior";?></a>
			<?php } ?>
<?php			
			for ($pag = $pag_inicio ; $pag < $pag_inicio + 10; $pag++)
			{
			   $classetabela = "btn-default btn-xs";
			   if ($pag==$p){
			   	 $classetabela = 'btn btn-primary btn-xs'; 
			   }
			   if ($pag <= $total_paginas){
			    ?><a class="btn <?php echo $classetabela;?>" onClick="montapaginacao(<?php echo $pag;?>,document.getElementById('nr').value)"><?php echo $pag;?></a>
			<?php 
			    }
			} ?>   
			<?php if ($p!=$total_paginas){
			?>
			<a class="btn btn-default btn-xs" onClick="montapaginacao(<?php echo $p+1;?>,document.getElementById('nr').value)"><?php echo "Próxima";?></a>
			<?php } ?>
			<a  class="btn btn-default btn-xs" onClick="montapaginacao(<?php echo $total_paginas;?>,document.getElementById('nr').value)"><?php echo " Última";?></a>
			</td>
          </tr>
		</table>	
	<?php 
	}
}
?>