@extends('produto')

@section('content')

<p><h5 class="text-center mb-4">Listar de Produtos Inativos</h5></p>

<p>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('cadastrar-produto') }}"><i class="fa fa-plus"></i> Cadastrar Novo Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('painel') }}"><i class="fa fa-plus"></i> Listar Produto Ativo</a>    
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>

<div class="row">
    <div class="col-md-12">
        <table class="table table-responsive">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Data Criação</th>
                <th>Data Modificação</th>
                <th>Operações</th> 
                <th><input class="form-control" id="myInput" type="text" placeholder="Filtrar.."></th>
            </tr>
            @foreach($produtos as $item)
            <tbody id="myTable">
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->marca}}</td>
                    <td>R$ {{$item->preco}}</td>
                    <td>{{$item->quantidade}}</td> 
                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                    <td>
                        <!--reativar produto-->
                        <a href="{{url('reativar-produto', Crypt::encrypt($item->id))}}" class="btn btn-primary btn-sm">Reativar</a>                    
                    </td>
                    <td>-</td>

                </tr>
            </tbody>
            @endforeach
        </table>
        
        <!--Alert remover produto-->
        @if(session('remover-produto'))
            <div class="alert alert-success mt-3">
                {{session('remover-produto')}}
            </div>
        @endif
        
        
    </div>
    
</div>
<script>
<!--Função para buscar resultado na tabela-->
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>    
@endsection