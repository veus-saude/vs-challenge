@extends('layouts.template_home')

@section('head')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
@endsection

@section('header')
<!--Aqui fica o conteúdo do header-->
@endsection

@section('section1')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('includes.aviso')

<section>
<div class="container espver4 espver3">
  <form action="{{route('cadastrar')}}" method="POST" id="frm_cadastro">
    @csrf
  <div class="row espver2 TextoAzul" style="padding-left: 8px; padding-bottom: 0px;">
     <div class="col-12 text-md-left"><p class="espver0 fbold" style="font-size: 20px;">
     Cadastramento de novos usuários</p>
     <div class="row TextoAzul">
        <div class="col-12 col-sm-12">
             <p class="TextoAzul text-left" style="margin-bottom: 5px; padding-bottom: 0px;">
                @include('includes.form-cadastro')
             </p>
             <p class="TextoAzul text-left" style="font-size: 12px; margin-top:0px; padding-top: 0px;">
               <strong>
                 (*) Ao criar o usuário, o sistema fará o disparo de um e-mail com as credenciais para acesso
               </strong>
             </p>
        </div>
     </div>
     </div>
  </div>
  <div class="row espver2 TextoAzul" style="padding-left: 8px; padding-bottom: 0px;">
     <div class="col-6 col-sm-6">
       <p class="text-center text-lg-left">
         <button id="btnSalvar" class="btn btn-secondary" onclick="confirmar()" style="padding-right: 40px; padding-left: 40px;">
           Cadastrar / salvar
         </button>
       </p>
     </div>
     <div class="col-6 col-sm-6">
       <p class="text-center text-lg-right">
         <button class="btn btn-secondary" onclick="limpaForm()" style="padding-right: 40px; padding-left: 40px;">
           Limpar
         </button>
       </p>
     </div>
  </div>
</form>
</div>
</section>

@endsection

@section('footer')
<!--Aqui fica o conteúdo do footer-->
@endsection

@section('script')
<script>
    //limpar formulário
    function limpaForm() {
        $('#name').val('');
        $('#email').val('');
        $('#senha').val('');
    }
    //mensagem de confirmação de cadastro
    function confirmar() {
      $('#frm_cadastro').submit();
      alert("Usuário criado com sucesso !");
    }
</script>
@endsection
