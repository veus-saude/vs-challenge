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
  <form action="{{route('cadastrar_produto')}}" method="POST" id="frm_cadpro">
    @csrf
  <div class="row espver2 TextoAzul" style="padding-left: 8px; padding-bottom: 0px;">
     <div class="col-12 text-md-left"><p class="espver0 fbold" style="font-size: 20px;">
     Cadastramento de novos produtos</p>
     <div class="row TextoAzul">
        <div class="col-12 col-sm-12">
           <p class="TextoAzul text-left" style="margin-bottom: 5px; padding-bottom: 0px;">
             <div class="row" style="padding-top: 15px;">
               <div class="col-12 col-sm-6 espver3 text-center text-sm-left">
                 <label for="nome">Nome:</label>
                 <input type="text" value="{{old('nome')}}" class="InputHome text-center text-sm-left" style="width:100%;{{$errors->has('nome')?'color:black;background-color:pink;':''}}" id="nome" placeholder="Nome completo" name="nome" pattern="^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9-_ .&'´`]{1,80}$" title="Favor preencher corretamente o campo nome" aria-label="Seu nome completo" required>
                 @if ($errors->has('nome'))
                   <br />
                   <span style="color:#FFD800;">
                       {{$errors->first('nome')}}
                   </span>
                 @endif

               </div>
             </div>
           </p>
        </div>
     </div>
     </div>
  </div>
  <div class="row espver2 TextoAzul" style="padding-left: 8px; padding-bottom: 0px;">
     <div class="col-6 col-sm-6">
       <p class="text-center text-lg-left">
         <button id="btnSalvar" class="btn btn-secondary" type="submit" style="padding-right: 40px; padding-left: 40px;">
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
        $('#nome').val('');
    }

</script>
@endsection
