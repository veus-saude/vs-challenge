<html>
<head>
<title>VEUS</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body>
    <form action="{{ Route('logon') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="container">
        <div class="alert alert-warning" role="alert"><div class="col-lg-12" align="center"><font color=#000"">Login</font></div></div>
            <div class="row">
                <div class="col-lg-3"><label>E-mail</label></div><div class="col-lg-3"><input type="text" name="email" id="email" placeholder="E-mail" required="required"></div>
                <div class="col-lg-3"><label>Senha</label></div><div class="col-lg-3"><input type="password" name="password" id="password" placeholder="Senha" required="required"></div>
            </div>
            <br>
            <div class="col-lg-12" align="center">
                <input type="submit" class="btn btn-warning" id="botao_login" value="Login">
            </div>
            <br>
            <div align="center" class="alert alert-success col-lg-12" role="alert" id="msgRetorno" style="display: none"></div>
	</div>
</form>
</body>
</html>