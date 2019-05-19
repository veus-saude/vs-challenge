@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Produtos</div>

                <div class="card-body">
                    <nav class="nav">
                        <a class="nav-link active" href="/produtos/create">Novo Produto</a>                        
                    </nav><br>
                   
                   
                    <form method="get" action="{{ route('produtos.search') }}">
                      
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="q" value="{{ old('q', isset($request->q) ? $request->q : null) }}" placeholder="Informe o nome do produto para realizar a busca">
                            
                            @include('partials.cb_brandByName')
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                            </div>
                        </div>
                        <div style="width: 150px; margin-left: 10px;" class="float-right">
                        <select class="custom-select pull-right" name="direction">
                                <option value="asc" {{ ((isset($request->direction) && $request->direction=="asc") ? 'selected' : null) }}>Crescente</option>
                                <option value="desc" {{ ((isset($request->direction) && $request->direction=="desc") ? 'selected' : null) }}>Decrescente</option>
                            </select> 
                        </div>
                        <div style="width: 150px;" class="float-right">
                        <select class="custom-select pull-right" name="sortBy">
                                <option value="" selected>Ordenar por</option>
                                <option value="name" {{ ((isset($request->sortBy) && $request->sortBy=="name") ? 'selected' : null) }}>Nome</option>
                                <option value="price" {{ ((isset($request->sortBy) && $request->sortBy=="price") ? 'selected' : null) }}>Preço</option>
                                <option value="quantity" {{ ((isset($request->sortBy) && $request->sortBy=="quantity") ? 'selected' : null) }}>Quantidade</option>
                            </select> 
                        </div>
                         
                    </form>
                   
                    <br> <br> <br>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col" width='15%'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($response['data']['data'] as $value)                               
                                <tr>
                                    <th scope="row">{{ $value['id'] }}</th>
                                    <td>{{ $value['name'] }}</td>
                                    <td>{{ $value['brand']['name'] }}</td>
                                    <td>{{ $value['quantity'] }}</td>
                                    <td>{{ number_format($value['price'], 2, ',', '.') }}</td>
                                    <td> 
                                        <a href="/produtos/{{ $value['id'] }}/edit" class="btn btn-info">Editar</a>
                                        <button type="button" id="{{$value['id']}}" action="/produtos" data-toggle="modal" data-target=".bs-example-modal-sm" class="btnExcluir btn btn-danger">Excluir</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
