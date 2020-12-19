<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Cadastro</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
      <link href="https://fonts.googleapis.com/css?family=Niramit:400,500,700" rel="stylesheet">
  </head>

  <body>
    <div class="container espver4 espver3">
      <div class="row espver2 TextoAzul" style="padding-left: 8px; padding-bottom: 0px;">
        <div class="col-12 col-md-10 col-md-offset-2 text-justify">
          <span><img class="img-responsive" width="80" height="auto" border="0" src="{{URL::asset('/images/logo.png')}}" style="padding-top: 2rem; padding-bottom: 2rem;" alt="API Veus" /></span><br /><br />
          <p>Prezado Cliente,</p>
          <p>Você está recebendo essa mensagem, pois cadastrou-se em nosso site para acesso a nossa API. </p>
          <p>Para utilização da API, deverá fazer o login no botão [Login] que será redirecionado para a página de pesquisa. </p><br /> 
          Usuário: {{$name}}<br />
          E-mail: {{$email}}<br />
          Senha: {{$senha}}</p>
          <p>Bons Negócios!<br />
          Equipe Veus</p>
        </div>
      </div>
    </div>
  </body>

</html>
