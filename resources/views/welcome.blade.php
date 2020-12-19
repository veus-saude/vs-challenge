@extends('layouts.template_home')

@section('head')
<!--Aqui fica o conteúdo do head-->
@endsection

@section('header')
<!--Aqui fica o conteúdo do header-->
@endsection

@section('section1')
@guest
@else
<script>window.location = "/home";</script>
@endguest
<div class="container">
  <div class="row" style="padding-left: 8px; padding-bottom: 0px; height: 500px">
    <div class="col-12 d-flex align-items-center justify-content-center">
      <h3><span>Sejam bem vindos ao site da API Veus.<br>
      Para ter acesso a nossa API, é necessário fazer o cadastro neste site.<br>
      Clique no botão [Cadastre-se] acima e você receberá um e-mail com as instruções<br>
      para acesso a API.</span></h3>
    </div>
  </div>
</div>
@endsection

@section('footer')
<!--Aqui fica o conteúdo do footer-->
@endsection

@section('script')
<!--Aqui ficam os links de script-->
@endsection
