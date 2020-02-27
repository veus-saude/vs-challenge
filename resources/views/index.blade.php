<html>
<head>
<title>VEUS</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<script language="javascript">
$(document).ready(function(){
    $('#botao_cadastro').click(function(data){
        $.post("{{ Route('register') }}",{
            '_token':'{{ csrf_token() }}',
            'email' : $('#email').val(),
            'password' : $('#password').val()
	});
        console.log(data);
        document.forms[0].reset();
        $('#msgRetorno').html('User saved successfully.');
        $('#msgRetorno').attr('display','block');
        $('#msgRetorno').fadeIn('slow');
        setTimeout("$('#msgRetorno').fadeOut('slow')",3750);
        setTimeout("$('#msgRetorno').attr('display','none')",5000);
    });
});
</script>
</head>

<body>
    <form>
    <div class="container">
        <div class="alert alert-warning" role="alert"><div class="col-lg-12" align="center"><font color=#000"">Registro de Usuário</font></div></div>
            <div class="row">
                <div class="col-lg-3"><label>E-mail</label></div><div class="col-lg-3"><input type="text" name="email" id="email" placeholder="E-mail" required="required"></div>
                <div class="col-lg-3"><label>Senha</label></div><div class="col-lg-3"><input type="password" name="password" id="password" placeholder="Senha" required="required"></div>
            </div>
            <br>
            <div class="col-lg-12" align="center">
                <input type="button" class="btn btn-warning" id="botao_cadastro" value="Cadastrar Usuário">
            </div>
            <br>
            <div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetorno" style="display: none"></div>
	</div>
</form>
</body>
</html>