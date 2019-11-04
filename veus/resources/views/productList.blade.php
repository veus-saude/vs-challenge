@extends('layout.app')
@section('body')
    <div class="container">
        <div class="card">
            <div class="text-center mt-3">
                <h2>Lista de Produtos</h2>
            </div>
            <div class="card-body">
                <form action="/products" method="get">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="col-md-6">
                            <label for="brand">Marca</label>
                            <input class="form-control" type="text" name="brand" id="brand">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="priceOperator">Operador Preço</label>
                            <select class="form-control" name="priceOperator">
                                <option value="">Selecione...</option>
                                <option value="=">Igual</option>
                                <option value=">">Maior</option>
                                <option value="<">Menor</option>
                                <option value=">=">Maior ou igual</option>
                                <option value="<=">Menor ou igual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="price">Preço</label>
                            <input  class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="stockOperator">Operador Estoque</label>
                            <select class="form-control" name="stockOperator">
                                <option value="">Selecione...</option>
                                <option value="=">Igual</option>
                                <option value=">">Maior</option>
                                <option value="<">Menor</option>
                                <option value=">=">Maior ou igual</option>
                                <option value="<=">Menor ou igual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="stock">Estoque</label>
                            <input  class="form-control" name="stock" id="stock">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </form>
                @if(count($product) > 0)
                    <table class="table table-bordered table-hover table-striped rounded">
                        <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $prod)
                            <tr>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->brand}}</td>
                                <td>{{ $prod->price}}</td>
                                <td>{{ $prod->stock }}</td>
                                <td>

                                    <a href="/api/v1/products/edit/{{$prod->id}}?api_token={{app('request')->input('api_token')}}" class="btn btn-sm btn-outline-info">
                                        <img class="my-auto tamanho-icone" src="{!! asset('img/edit.svg') !!}" >
                                    </a>
                                    <form action="/products" method="delete">
                                        <button type="submit"
                                           class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir este registro?')">
                                            <img class="my-auto tamanho-icone" src="{!! asset('img/trash-2.svg') !!}">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <a href="/api/v1/products/new?api_token={{app('request')->input('api_token')}}" class="btn btn-outline-primary" role="button">Novo</a>
                    </div>
                    {{$product->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
