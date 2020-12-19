@extends('layouts.template_home')

@section('head')
<!--Aqui fica o conteúdo do head-->

@endsection

@section('header')
<!--Aqui fica o conteúdo do header-->
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">

@endsection

@section('section1')
@include('includes.excluir-modal')

<div class="container-fluid">
  <div class="row espver2 justify-content-center">
    <div class="col-12">
      <h5>Cadastro de Produtos - Listagem</h5>
    </div>
  </div>
  <!-- <form action="{{route('busca')}}" method="POST" id="frm_busca"> -->
  <!-- .espver0 { margin-top: 0px; margin-bottom: 0px }
  .espver { margin-top: 10px; }
  .espver2 { margin-top: 30px; }
  .espver3 { margin-bottom: 30px; }
  .espver4 { margin-bottom: 60px; } -->

    @csrf
    <div class="row">
      <div class="col-12">
        <label for="filter-url" class="form-label">Filtrar Busca</label>
        <div class="input-group mb-1">
          <span class="input-group-text">Nome</span>
          <input id="inome" name="fnome" type="text" class="form-control" aria-label="Nome" aria-describedby="basic-addon1">
          <span class="input-group-text">Fornecedor</span>
          <input id="ifornecedor" name="ffornecedor" type="text" class="form-control" aria-label="Fornecedor" aria-describedby="basic-addon2">
        </div>
        <div class="input-group mb-1">
          <span class="input-group-text">Lote</span>
          <input id="ilote" name="flote" type="text" class="form-control" aria-label="Lote" aria-describedby="basic-addon3">
          <span class="input-group-text" title="considerar sempre o primeiro dia do mês">Fabricação</span>
          <input id="ifabricacao" name="ffabricacao" type="date" class="form-control" aria-label="Fabricação" title="considerar sempre o primeiro dia do mês" aria-describedby="basic-addon4">
          <span class="input-group-text" title="considerar sempre o primeiro dia do mês">Vencimento</span>
          <input id="ivalidade" name="fvalidade" type="date" class="form-control" aria-label="Validade" title="considerar sempre o primeiro dia do mês" aria-describedby="basic-addon5">
        </div>
      </div>
    </div>
    <div class="row espver espver3">
      <div class="col-3">
        <!-- <a class="btn btn-secondary" href="" onclick="filtra_registro()">Filtrar</a> -->
        <a class="btn btn-secondary" href="" id="btn_confirma">Buscar</a>
        <a class="btn btn-secondary" href="{{route('home')}}">Limpar Filtro</a>
      </div>
      @guest
      @else
      @if(Auth::user()->isAdmin())
        <div class="col-2">
          <a class="btn btn-secondary" href="{{route('cadastro_produto')}}">Incluir Produto</a>
        </div>
        <div class="col-2">
          <a class="btn btn-secondary" href="{{route('cadastro_estoque')}}">Atualizar Estoque</a>
        </div>
      @endif
      @endguest
    </div>
    <!-- </form> -->
    <div id="tabela">
    <hr class="espver0" />
    <div class="row espver0 fbold TextoAzul" style="font-size: 14px">
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center">Código</div>
      <div class="col-3 col-sm col-md-3 col-lg-3 text-center">Nome</div>
      <div class="col-2 col-sm col-md-2 col-lg-2 text-center">Fornecedor</div>
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center">Lote</div>
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center">Fabricação</div>
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">Validade</div>
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">Quantidade</div>
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">Valor</div>
      @guest
      @else
      @if(Auth::user()->isAdmin())
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">Ações</div>
      @endif
      @endguest
    </div>
    <hr class="espver0" />
    <?php $i = 0; ?>
    @foreach($produtos as $produto)
    <div class="row espver0 TextoAzul" style="font-size: 13px">
      <div id="diid{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-center">
        {{$produto->id}}
      </div>
      <div id="dinome{{$i}}" class="col-3 col-sm col-md-3 col-lg-3 text-left">
        {{$produto->nome}}
      </div>
      <div id="difornecedor{{$i}}" class="col-2 col-sm col-md-2 col-lg-2 text-left">
        {{$produto->fornecedor}}
      </div>
      <div id="dilote{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-center">
        {{$produto->lote}}
      </div>
      <div id="difabricacao{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-center">
        {{date('m/Y',strtotime($produto->fabricacao))}}
      </div>
      <div id="divalidade{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">
        {{date('m/Y',strtotime($produto->validade))}}
      </div>
      <div id="diquantidade{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">
        {{$produto->quantidade}}
      </div>
      <div id="divalor{{$i}}" class="col-1 col-sm col-md-1 col-lg-1 text-right text-nowrap">
        {{'R$ '.number_format($produto->valor, 2, ',', '.')}}
      </div>
      @guest
      @else
      @if(Auth::user()->isAdmin())
      <div class="col-1 col-sm col-md-1 col-lg-1 text-center text-nowrap">
        <a class="text-center" style="margin-left: 6px; margin-right: 6px; font-size: 16px; align-self: baseline;" onclick="edit({{ $produto->id }})"><i class="fas fa-edit" style="cursor: pointer" title="Alterar produto"></i></a>
        <a class="text-center" style="margin-left: 6px; margin-right: 6px; font-size: 16px; align-self: baseline;" data-toggle="modal" data-target="#deleteModal" onclick="del({{ $produto->id }})"><i class="fas fa-trash-alt" style="cursor: pointer" title="Excluir produto"></i></a>
      </div>
      @endif
      @endguest
      <?php $i++; ?>
    </div>
    <hr class="espver0" />
    @endforeach
    <div class="row espver2 fbold TextoAzul" style="font-size: 14px">
      <div id="plinks" class="col-12 d-flex justify-content-center">{{$produtos->links()}}</div>
    </div>
    <hr class="espver0" />
  </div>
      <form action="{{route('altera_produto')}}" method="GET" id="edit_form">
        @csrf
        <input type="hidden" name="id" value="" id="ed" />
      </form>

    </div>
    <?php
    function limpa_valores($i) {
      for ($j = 0; $j < $i; $j++){
        echo 'document.getElementById("diid'.$j.'").innerHTML = "";';
        echo 'document.getElementById("dinome'.$j.'").innerHTML = "";';
        echo 'document.getElementById("difornecedor'.$j.'").innerHTML = "";';
        echo 'document.getElementById("dilote'.$j.'").innerHTML = "";';
        echo 'document.getElementById("difabricacao'.$j.'").innerHTML = "";';
        echo 'document.getElementById("divalidade'.$j.'").innerHTML = "";';
        echo 'document.getElementById("diquantidade'.$j.'").innerHTML = "";';
        echo 'document.getElementById("divalor'.$j.'").innerHTML = "";';
        echo 'document.getElementById("plinks").innerHTML = "";';
      };
    }
    ?>

    @endsection

    @section('footer')
    <!--Aqui fica o conteúdo do footer-->
    @endsection

    @section('script')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      // $('#example').DataTable({
      //   language: {
      //     url: 'pt_br.json'
      //   },
      //   responsive: true,
      // } );
      $('#btn_confirma').click(function (e) {
       e.preventDefault();
       //$('#frm_busca').submit();
       if ($('#inome').val() != '' || $('#ifornecedor').val() != '' || $('#ilote').val() != '' || $('#ifabricacao').val() != '' || $('#ivalidade').val() != '') {
         filtra_registro();
         return false;
       }
     });
    });

    var nome, fornecedor, lote, fabricacao, validade, linha;
    function filtra_registro() {
      if ($('#inome').val() != '') {
          nome = 'products?q='+$('#inome').val();
      } else {
        nome = 'products?q=';
      }
      if ($('#ifornecedor').val() != '') {
          fornecedor = '&filter=brand:'+$('#ifornecedor').val();
      }
      if ($('#ilote').val() != '') {
          lote = '&filter=lote:'+$('#ilote').val();
      }
      if ($('#ifabricacao').val() != '') {
          fabricacao = '&filter=fabricacao:'+$('#ifabricacao').val();
      }
      if ($('#ivalidade').val() != '') {
          validade = '&filter=validade:'+$('#ivalidade').val();
      }
      if (nome != undefined && fornecedor == undefined && lote == undefined && fabricacao == undefined && validade == undefined) {
        linha = nome;
      }
      if (nome != undefined && fornecedor != undefined && lote == undefined && fabricacao == undefined && validade == undefined) {
        linha = nome+fornecedor;
      }
      if (nome != undefined && fornecedor != undefined && lote != undefined && fabricacao == undefined && validade == undefined) {
        linha = nome+fornecedor+lote;
      }
      if (nome != undefined && fornecedor != undefined && lote != undefined && fabricacao != undefined && validade == undefined) {
        linha = nome+fornecedor+lote+fabricacao;
      }
      if (nome != undefined && fornecedor != undefined && lote != undefined && fabricacao != undefined && validade != undefined) {
        linha = nome+fornecedor+lote+fabricacao+validade;
      }
      if (nome == undefined && fornecedor != undefined && lote == undefined && fabricacao == undefined && validade == undefined) {
        linha = fornecedor;
      }
      if (nome == undefined && fornecedor != undefined && lote != undefined && fabricacao == undefined && validade == undefined) {
        linha = fornecedor+lote;
      }
      if (nome == undefined && fornecedor != undefined && lote != undefined && fabricacao != undefined && validade == undefined) {
        linha = fornecedor+lote+fabricacao;
      }
      if (nome == undefined && fornecedor != undefined && lote != undefined && fabricacao != undefined && validade != undefined) {
        linha = fornecedor+lote+fabricacao+validade;
      }
      if (nome == undefined && fornecedor == undefined && lote != undefined && fabricacao == undefined && validade == undefined) {
        linha = lote;
      }
      if (nome == undefined && fornecedor == undefined && lote != undefined && fabricacao != undefined && validade == undefined) {
        linha = lote+fabricacao;
      }
      if (nome == undefined && fornecedor == undefined && lote != undefined && fabricacao!= undefined && validade != undefined) {
        linha = lote+fabricacao+validade;
      }
      if (nome != undefined && fornecedor == undefined && lote != undefined && fabricacao == undefined && validade == undefined) {
        linha = nome+lote;
      }
      if (nome == undefined && fornecedor == undefined && lote == undefined && fabricacao != undefined && validade == undefined) {
        linha = fabricacao;
      }
      if (nome == undefined && fornecedor == undefined && lote == undefined && fabricacao != undefined && validade != undefined) {
        linha = fabricacao+validade;
      }
      if (nome != undefined && fornecedor == undefined && lote == undefined && fabricacao != undefined && validade != undefined) {
        linha = nome+fabricacao+validade;
      }
      if (nome == undefined && fornecedor == undefined && lote == undefined && fabricacao != undefined && validade == undefined) {
        linha = nome+fornecedor+fabricacao;
      }

      $.ajax({
      type: "GET",
      dataType: "json",
      async: true,
      url: "/api/v1/"+linha,
      success: function(data) {
        console.log(data);
        <?php limpa_valores($i);?>
        for (var i = 0; i < data.data.data.length; i++) {
          document.getElementById('diid'+i).innerHTML = data.data.data[i].id;
          document.getElementById('dinome'+i).innerHTML = data.data.data[i].nome;
          document.getElementById('difornecedor'+i).innerHTML = data.data.data[i].fornecedor;
          document.getElementById('dilote'+i).innerHTML = data.data.data[i].lote;
          document.getElementById('difabricacao'+i).innerHTML = data.data.data[i].fabricacao;
          document.getElementById('divalidade'+i).innerHTML = data.data.data[i].validade;
          document.getElementById('diquantidade'+i).innerHTML = data.data.data[i].quantidade;
          document.getElementById('divalor'+i).innerHTML = data.data.data[i].valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        };
        for (var j = data.data.data.length+1; j < {{$i}}; j++) {
          document.getElementById('diid'+j).remove();
          document.getElementById('dinome'+j).remove();
          document.getElementById('difornecedor'+j).remove();
          document.getElementById('dilote'+j).remove();
          document.getElementById('difabricacao'+j).remove();
          document.getElementById('divalidade'+j).remove();
          document.getElementById('diquantidade'+j).remove();
          document.getElementById('divalor'+j).remove();
        };

      },
      error: function(error) {
        console.log(error.msg);
      }
    });
    }

    $('#excluirProModal').click(function () {
    if (colID === '') {
      alert('Selecione o produto para exclusão');
    } else {
        $.ajax({
          data: { '_token': '{{csrf_token()}}', 'produto': colID },
          url: '{{route("excluir_produto")}}',
          async: true,
          type: 'GET',
          success: function (data) {
            alert('Produto Excluído!');
            $('.modal .close').click();
            window.location.reload();
          },
          error: function (err) {
            alert('Ops! Algo deu errado.');
            $('.modal .close').click();
          }
        });
      }
    })

    function recarregar_pagina() {
      window.location.href = "{{env('APP_URL')}}/";
    }

    function edit(id) {
      $('#ed').val(id);
      $('#edit_form').submit();
    }

    function del(id) {
      $('#ed').val(id);
      colID = id;
    }

  </script>
  <!-- https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL -->

  @endsection
