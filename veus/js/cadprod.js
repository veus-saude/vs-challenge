$('document').ready(function(){
	
	$('button').click(function(){
		if($(this).text() == 'Gravar'){
			
				if($("form input[name='nomeprod']").val()){ //verifica se os dados foram digitados
					if($("form input[name='marcaprod']").val()){
						if($("form input[name='precoprod']").val()){
							if($("form input[name='qtdprod']").val()){
								
								var nm_prod = $("form input[name='nomeprod']").val();
								var marcaprod = $("form input[name='marcaprod']").val();
								var precoprod = $("form input[name='precoprod']").val();
								var qtdprod = $("form input[name='qtdprod']").val();
								
								
								$('form').submit();
								
							}else{
								alert('favor informe a quatidade em estoque do produto');
							}
							
						}else{
							alert('favor informe o preço do produto');
						}
						
					}else{
						alert('favor informe a marca do produto');
					}
					
				}else{
					alert('favor informe o nome do produto');
				}
			
			
		}
	});
	
	$("form input[name='precoprod']").mask('###0.00', {reverse: true});
	$("form input[name='qtdprod']").mask('0#');
	
	$('#icon_search').click(function(){
		window.location.replace('search_prod.php');
	});
	
});