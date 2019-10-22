<?php
	include "conect.php";

	$marca = isset($_POST['marca'])?$_POST['marca']:'';
	$nmprod = isset($_POST['nmprod'])?$_POST['nmprod']:'';
	$where = "";
	
	if($marca && $nmprod){
		$where ="where ds_marca = '".$_POST['marca']."' and upper(ds_prod) like upper('%".$_POST['nmprod']."%')" ;
	}else{
		if(!($marca) && !($nmprod)){
			$where = "";
		}else{
			if(!($marca)){
				$where ="where upper(ds_prod) like upper('%".$_POST['nmprod']."%')" ;
			}else{
				if(!($nmprod)){
					$where ="where ds_marca = '".$_POST['marca']."' " ;
				}
			}
		}
	}
	


	$busca_prod = mysqli_query($conect,"SELECT * FROM `produto` ".$where." ") or die(mysqli_error($conect));
	$num_rows = mysqli_num_rows($busca_prod);
	
	$pagination = $num_rows / 10;
	
	$pagination = (int)$pagination;
	/*if($num_rows % 10 >0){
		$pagination ++;
	}*/
	
	$mensagem = '';
		for($i = 0; $i <= $pagination; $i++){
			if($i == 0 ){
				$j = $i;
			}else{				
				$j = ($i * 10)+1;
			}
			
			$k = $i+1;
			
			$busca = mysqli_query($conect,"SELECT * FROM `produto` ".$where." limit ".$j .",10") or die(mysqli_error($conect));
			
			$mensagem .= "<div class='pagination' id='".$k."'>
							<table class='listprod'>";		
			while($resposta = mysqli_fetch_assoc($busca)){
					$mensagem .= "
						
						
											<tr>
												<td class='tdnome'>".$resposta['ds_prod']."</td>
												<td class='tdmarca'>".$resposta['ds_marca']."</td>
												<td class='tdpreco'>".$resposta['vl_preco']."</td>
												<td class='tdqtest'>".$resposta['qt_estoque']."</td>
												<td class='tdedit'><img src='img/edit.png'  id='".$resposta['id_prod']."'></td>
												<td class='tddelete'><img src='img/del.png'  id='".$resposta['id_prod']."'></td>
											</tr>

					";
			}
			$mensagem .= "</table>
						</div>";
		}


	echo $mensagem;
	

?>