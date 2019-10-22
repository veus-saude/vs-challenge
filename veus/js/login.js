$('document').ready(function(){
	$('div button').click(function(){
		
		if($(this).text() == 'Entrar'){
			
			if($("form input[name='login']").val()){
					var login = $("form input[name='login']").val();
					$("form input[name='login']").css('border','none');
				
				if($("form input[name='pass']").val()){
					var senha = $("form input[name='pass']").val();
					$("form input[name='pass']").css('border','none');
					
					$.post('login_exec.php',{login:login, senha:senha}, function(data){
						if(data == 'usuário não encontrado, favor tente novamente'){							
							alert(data);
						}else{
							window.location.replace(data);
						}
						
					});
					
					
				}else{
					$("form input[name='pass']").css('border','solid 2px #CD3333');
					alert('Favor informe uma senha');
				}
				
			}else{
					$("form input[name='login']").css('border','solid 2px #CD3333');
					alert('Favor informe um login');
				
			}
			
			
		}else{
			
			alert('cadastrando');
		}
	});
	
});