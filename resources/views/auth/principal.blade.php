@extends('produto')

  
@section('content')

<h5 class="text-center mb-4">Listar de Produtos Ativos</h5>

<p>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('cadastrar-produto') }}"><i class="fa fa-plus"></i> Cadastrar Novo Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-produto-inativo')}}"><i class="fa fa-plus"></i> Produto Inativo</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>


        <!--Alert remover produto-->
        @if(session('remover-produto'))
            <div class="alert alert-success mt-3">
                {{session('remover-produto')}}
            </div>
        @endif
        <!--Alert remover produto-->
        
        <!--Alert Sucesso-->
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{session('success')}}
            </div>
        @endif
        <!--Alert Sucesso-->

<!--Pesquisa início-->
<div class="row">
    <div class="col-sm-4">

        <form action="{{route('escopo-pesquisa')}}" method="GET" class="form-inline">
            
            <div class="form-group">                
                <input type="text" class="form-control" name="pesquisa" value="{{ $pesquisa ?? "" }}" placeholder="Digite a informação.">                
            </div>
            
            <div class="form-group">                
                <button type="submit" class="btn btn-success btn-block btn-sm">Pesquisar</button> 
                
                
            </div>
            
        </form>
        
        
    </div>
    
</div>
<!--Pesquisa fim-->


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
                <th>Vizualizar</th>
                <th>Operações</th>
                <th>-</th>
                <th>-</th>
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
                    <a href="{{route('visualizar-produto', Crypt::encrypt($item->id))}}" class="btn btn-primary btn-sm">Visualizar</a>
                </td>
                <td>
                    <a href="{{route('editar', Crypt::encrypt($item->id))}}" class="btn btn-warning btn-sm">Editar</a>                      
                </td>
                                
                <td>
                    <!--Remover Produto! forma-delete class para lincar a função de confirmação de exclusão -->
                    <form action="{{route('remover-produto', Crypt::encrypt($item->id))}}" method="POST" class="d-inline form-delete">
                        @method('DELETE')
                        @csrf
                        
                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                    <!--Remover Produto-->
                </td>
                
                <td>
                    <!--Inativar-->
                    <a href="{{url('inativar-produto', Crypt::encrypt($item->id))}}" class="btn btn-secondary btn-sm">Inativar</a>
                    
                </td>
                
                <td>-</td>
                                
            </tr>
            </tbody>
            
            @endforeach
        </table>
        
        
        
        <!--Paginação de produtos PAGINATE-->
        {{ $produtos->appends(['pesquisa' => $pesquisa ?? ''])->links() }}
    
    </div>
    
</div>


<script>
<!--Função para buscar resultado na tabela (Filtrar) função do bootstrap-->
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

<!--Função para confirmar exclusão do produto-->
$(document).on('submit', '.form-delete', function(){
    return confirm('Deseja realemte excluir esse item?');
});

</script>
    
@endsection