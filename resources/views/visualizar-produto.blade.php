@extends('produto')

  
@section('content')

<h5 class="text-center mb-4">Informações Básicas do Produto</h5>


<p>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('cadastrar-produto') }}"><i class="fa fa-plus"></i> Cadastrar Novo Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-produto-inativo')}}"><i class="fa fa-plus"></i> Produto Inativo</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>

<div class="row">

    <div class="col-md-12">
        
        <table class="table table-responsive">
            
            <thead>Nesta transação é possível imprimir!</thead>
            <tbody>                
                <tr>                
                    <th>Nome:</th>
                    <td>{{$produtos->nome}}</td>
                </tr>
                <tr>                
                    <th>Marca:</th>
                    <td>{{$produtos->marca}}</td>
                </tr>
                <tr>                
                    <th>Preço:</th>
                    <td>{{$produtos->preco}}</td>
                </tr>
                <tr>                
                    <th>Quantidade:</th>
                    <td>{{$produtos->quantidade}}</td>
                </tr>                
            </tbody>
                        
        </table>
        
        <div class="row">
            
            <div class="col-sm-1">
                <a class="btn btn-primary btn-block btn-sm" href="<?php echo URL::previous(); ?>">Voltar</a>                
            </div>
            
            <div class="col-sm-1">
                <a class="btn btn-primary btn-block btn-sm" onclick="window.print('visualizar-produto.php');">Imprimir</a>
            </div>
            
        </div>
        
        
                           
    </div>
    
</div>


<script>

</script>
    
@endsection