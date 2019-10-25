@extends('produto')

@section('content')

<h5 class="text-center mb-4">Produto Vazio!</h5>

<p>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('painel') }}"><i class="fa fa-plus"></i> Listar Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-produto-inativo')}}"><i class="fa fa-plus"></i> Produto Inativo</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>
    
@endsection