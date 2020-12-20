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
    <table id="example" class="display stripe border nowrap" style="width:100%">
      <thead>
        <tr>
          <th class="text-center text-nowrap">Código</th>
          <th class="text-center text-nowrap">Nome</th>
          <th class="text-center text-nowrap">Fornecedor</th>
          <th class="text-center text-nowrap">Lote</th>
          <th class="text-center text-nowrap">Fabricação</th>
          <th class="text-center text-nowrap">Validade</th>
          <th class="text-center text-nowrap">Quantidade</th>
          <th class="text-center text-nowrap">Valor</th>
          @guest
          @else
          @if(Auth::user()->isAdmin())
          <th class="text-center text-nowrap">Editar</th>
          <th class="text-center text-nowrap">Excluir</th>
          @endif
          @endguest
        </tr>
      </thead>
      <tbody>
        @foreach($produtos as $produto)
        <tr>
          <td class="text-center text-nowrap">{{$produto->id}}</td>
          <td>{{$produto->nome}}</td>
          <td>{{$produto->fornecedor}}</td>
          <td class="text-center text-nowrap">{{$produto->lote}}</td>
          <td class="text-center text-nowrap">{{date('m/Y',strtotime($produto->fabricacao))}}</td>
          <td class="text-center text-nowrap">{{date('m/Y',strtotime($produto->validade))}}</td>
          <td class="text-center text-nowrap">{{$produto->quantidade}}</td>
          <td class="text-right text-nowrap">{{'R$ '.number_format($produto->valor, 2, ',', '.')}}</td>
          @guest
          @else
          @if(Auth::user()->isAdmin())
          <td class="text-center text-nowrap"><a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" onclick="edit({{ $produto->id }})"><i class="fas fa-edit" style="cursor: pointer" title="Alterar produto"></i></a></td>
            <td class="text-center text-nowrap"><a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" data-toggle="modal" data-target="#deleteModal" onclick="del({{ $produto->id }})"><i class="fas fa-trash-alt" style="cursor: pointer" title="Excluir produto"></i></a></td>
          @endif
          @endguest
            </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center text-nowrap">Código</th>
              <th class="text-center text-nowrap">Nome</th>
              <th class="text-center text-nowrap">Fornecedor</th>
              <th class="text-center text-nowrap">Lote</th>
              <th class="text-center text-nowrap">Fabricação</th>
              <th class="text-center text-nowrap">Validade</th>
              <th class="text-center text-nowrap">Quantidade</th>
              <th class="text-center text-nowrap">Valor</th>
              @guest
              @else
              @if(Auth::user()->isAdmin())
              <th class="text-center text-nowrap">Editar</th>
              <th class="text-center text-nowrap">Excluir</th>
              @endif
              @endguest
            </tr>
          </tfoot>
        </table>
      <form action="{{route('altera_produto')}}" method="GET" id="edit_form">
        @csrf
        <input type="hidden" name="id" value="" id="ed" />
      </form>

    </div>

    @endsection

    @section('footer')
    <!--Aqui fica o conteúdo do footer-->
    @endsection

    @section('script')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>


    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
      $('#example').DataTable({
        language: {
          url: 'pt_br.json'
        },
        responsive: true,
      } );
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
        $('#example').DataTable().destroy();
        $('#example').DataTable({
          language: {
            url: 'pt_br.json'
          },
          responsive: true,
          data: data.data.data,
          columns: [
              { title: "Código" , data: 'id', className: 'dt-body-center' },
              { title: "Nome" , data: 'nome' },
              { title: "Fornecedor" , data: 'fornecedor' },
              { title: "Lote" , data: 'lote', className: 'dt-body-center' },
              { title: "Fabricação" , data: 'fabricacao', className: 'dt-body-center' },
              { title: "Validade" , data: 'validade', className: 'dt-body-center' },
              { title: "Quantidade" , data: 'quantidade', className: 'dt-body-center' },
              { title: "Valor" , data: 'valor', render: $.fn.dataTable.render.number( ',', '.', 2, 'R$ ' ), className: 'dt-body-right' },
              { title: "Editar" , data: 'editar', className: 'dt-body-center' },
              { title: "Excluir" , data: 'excluir', className: 'dt-body-center' },
          ]
        } );
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
