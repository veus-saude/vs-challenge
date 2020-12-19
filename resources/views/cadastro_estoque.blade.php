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
    <form action="{{route('cadastrar_estoque')}}" method="POST" id="frm_cadpro">
      @csrf
      <div class="row espver4">
        <div class="col-12"><p class="espver0 fbold" style="font-size: 20px;">
          Lançamento no estoque de produtos (*)</p>
        </div>
      </div>
      <div class="row espver4">
        <div class="col-12">
          <p class="TextoAzul text-left" style="margin-bottom: 5px; padding-bottom: 0px;">
            <div class="row espver4" style="margin-top: 120px; padding-bottom: 120px;">
              <div class="col-12">
                <div class="input-group mb-3">
                  <span class="input-group-text">Produto</span>
                  <select class="form-control" name="id_produto" aria-label="Produto" aria-describedby="basic-addon2">
                    <option value="0">Selecione</option>
                    @foreach($produtos as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @endforeach
                  </select>
                  <span class="input-group-text">Fornecedor</span>
                  <select class="form-control" name="id_fornecedor" aria-label="Fornecedor" aria-describedby="basic-addon1">
                    <option value="0">Selecione</option>
                    @foreach($fornecedores as $fornecedor)
                    <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Lote</span>
                  <input id="ilote" name="lote" type="text" class="form-control" aria-label="Lote" aria-describedby="basic-addon3">
                  <span class="input-group-text" title="considerar sempre o primeiro dia do mês">Fabricação</span>
                  <input id="ifabricacao" name="fabricacao" type="date" class="form-control" aria-label="Fabricação" aria-describedby="basic-addon4">
                  <span class="input-group-text" title="considerar sempre o primeiro dia do mês">Vencimento</span>
                  <input id="ivalidade" name="validade" type="date" class="form-control" aria-label="Vencimento" aria-describedby="basic-addon5">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">Quantidade</span>
                  <input id="iquantidade" name="quantidade" type="number" class="form-control" aria-label="Quantidade" aria-describedby="basic-addon6">
                  <span class="input-group-text">Valor</span>
                  <input id="ivalor" name="valor" type="text" class="form-control" aria-label="Valor" aria-describedby="basic-addon6">
                  <script>
                    $('#ivalor').mask('#.##0,00', {reverse: true});
                  </script>

                </div>
              </div>
            </div>
          </p>
        </div>
      </div>
      <div class="row espver4">
        <div class="col-12"><p class="espver0 fbold" style="font-size: 20px;">
          * Este cadastro é apenas para simular o lançamento de produtos no estoque. No mundo real, este lançamento deve ser realizado a partir de uma nota fiscal de compra, referente aos produtos adquiridos do fornecedor.
        </div>
      </div>
      <div class="row espver4">
        <div class="col-6">
          <p class="text-center text-lg-left">
            <input type="submit" class="btn btn-secondary" style="padding-right: 40px; padding-left: 40px;" value="Cadastrar / salvar">
          </p>
        </div>
        <div class="col-6">
          <p class="text-center text-lg-right">
            <input type="reset" class="btn btn-secondary" style="padding-right: 40px; padding-left: 40px;" value="limpar">
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

@endsection
