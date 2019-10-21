@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produtos
                    <form action="/products" method="get">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="text" name="q">
                        <button class="btn btn-sm" type="Submit">Pesquisar</button>
                        <a href="{{action('ProdutosController@view')}}" class="btn btn-sm" >Limpar</a>
                    </form>

                    <div class="float-right">
                        <a href="{{action('ProdutosController@new')}}" type="button" class="btn btn-success btn-sm">Novo</a>
                    </div>
                </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->marca}}</td>
                                <td>R$ {{$produto->preco}}</td>
                                <td>{{$produto->quantidade}}</td>
                                <td><a href="{{action('ProdutosController@edit', $produto->produto)}}"  >Editar</a></td>
                                <td><a href="{{action('ProdutosController@delete', $produto->produto)}}"  >Excluir</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{$produtos}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

