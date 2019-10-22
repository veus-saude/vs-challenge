$('document').ready(function(){
	busca_prd();del_pro();edit_pro();
	
	$('.addprod').click(function(){
		window.location.replace('cadastro_prod.php');
	});
	
	$("#search input[name='search']").keyup(function(){
		var inputsearch = $("#search input[name='search']").val();
		var selectsearch = $('#search select').val();
		
		if(selectsearch == 'nda'){
			selectsearch = '';
		}
		if(inputsearch.length > 3){
				$.post("busca_produtos.php",{marca:selectsearch, nmprod:inputsearch},function(data){
					$('#lista_prod').html(data);
					var table ='';
					var num = $('#lista_prod').find('.pagination').last().attr('id');
					for(var i = 1 ; i <= num; i++ ){
						 table = table +"<td>"+i+"</td>";
						
					}
					$('#pagination tr').html(table);
					//alert(data);
					pagination();
					del_pro();edit_pro();
				});
			
		}else{
			busca_prd();del_pro();edit_pro();
		}
	});
	
	
	$('#search select').change(function(){
		filtro = $(this).val();
		
		if($("#search input[name='search']").val()){
			var inputsearch = $("#search input[name='search']").val();
		}else{
			var inputsearch = '';
		}
		
		if(filtro == 'nda'){
			busca_prd();del_pro();edit_pro();
		}else{
		

				$.post("busca_produtos.php",{marca:filtro, nmprod:inputsearch},function(data){
					
					$('#lista_prod').html(data);
					var table ='';
					var num = $('#lista_prod').find('.pagination').last().attr('id');
					for(var i = 1 ; i <= num; i++ ){
						 table = table +"<td>"+i+"</td>";
						
					}
					$('#pagination tr').html(table);
					//alert(data);
					pagination();
					del_pro();edit_pro();
				});
				pagination();
			
			
		}
	});
	


});
	function pagination(){
		$('#pagination td').click(function(){
			var pg = $(this).text();
			pg = '#lista_prod #'+pg;
			//alert(pg);
			$('.pagination').hide();
			$(pg).show();
			//alert(pg);
		});
	};
	
	function busca_prd(){
		
		if($("#search input[name='search']").val()){
			var inputsearch = $("#search input[name='search']").val();
		}else{
			var inputsearch = '';
		}
		
		if($('#search select').val() != 'nda'){
			var selectsearch = $('#search select').val();
		}else{
			var selectsearch = '';
		}
		
		$.post("busca_produtos.php",{marca:selectsearch,nmprod:inputsearch},function(data){
		$('#lista_prod').html(data);
			var num = $('#lista_prod').find('.pagination').last().attr('id');
			var table ='';
			//alert(num);
			for(var i = 1 ; i <= num; i++ ){
				 table = table +"<td>"+i+"</td>";
				
			}
			$('#pagination tr').html(table);
			pagination();
			del_pro();edit_pro();
		
	});
		
	};
	
	
	function del_pro(){
		$('.listprod .tddelete img').click(function(){
		var id = $(this).attr('id');
		
		
		$.post("del_exec.php",{id:id},function(data){
			alert(data);
			location.reload();
		});
	});
	}
	
	function edit_pro(){
		$('.listprod .tdedit img').click(function(){
		var id = 		$(this).attr('id');
		var nm_prod =   $(this).parent().parent().find(".tdnome").text();
		var ds_marca =  $(this).parent().parent().find(".tdmarca").text();
		var ds_preco =  $(this).parent().parent().find(".tdpreco").text();
		var qt_est = 	$(this).parent().parent().find(".tdqtest").text();
		
		var trid = $(this).parent().parent().parent().parent().parent().attr('id');
		
		trid = '#'+trid;
		
		var html = "<tr class='tredit'><td colspan='6'><input type='text' name='hidden' value='"+id+"' hidden><label>Nome:</label><input type='text' name='ds_prod' value='"+nm_prod+"'><label>Marca:</label><input type='text' name='ds_marca' value='"+ds_marca+"'><label>Quantidade em Estoque:</label><input type='text' name='qtdest' value='"+qt_est+"'><label>Valor:</label><input type='text' name='ds_preco' value='"+ds_preco+"'><button>Editar</button></td></tr>";
		
		var index = $(this).parent().parent().index();
		

		$('.tredit').remove();
		$(html).insertAfter(trid+" .listprod tr:nth('"+index+"')");
		
			$(".tredit input[name='ds_preco']").mask('###0.00', {reverse: true});
			$(".tredit input[name='qtdest']").mask('0#');
			
		bt_edit();

	});
	}

	function bt_edit(){
		$('.tredit button').click(function(){
			var id = $(".tredit input[name='hidden']").val();
			var nm_prod =   $(".tredit input[name='ds_prod']").val();
			var ds_marca =  $(".tredit input[name='ds_marca']").val();
	        var ds_preco =  $(".tredit input[name='ds_preco']").val();
            var qtdest = 	$(".tredit input[name='qtdest']").val();
			
			
			if(id && nm_prod && ds_marca && ds_preco && qtdest){
				$.post("edit_prod.php",{id:id,nm_prod:nm_prod,ds_marca:ds_marca,ds_preco:ds_preco,qtdest:qtdest}, function(data){
					alert(data);
					window.location.reload();
				});
			}else{
				alert('Favor preencha corretamente os dados para gravar');
			}
			});
	}