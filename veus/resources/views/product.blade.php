@extends('layout.app')
@section('body')
    <div class="container">
        <div class="card">
            <div class="text-center mt-3">
                <h2>Cadastro de Produtos</h2>
            </div>
            <div class="card-body">
                <form action="{{ isset($product->id)
                        ? '/api/v1/products/'.$product->id.'?api_token='.app('request')->input('api_token')
                        : '/api/v1/products?api_token='.app('request')->input('api_token') }}"
                      method="{{isset($product->id) ? 'put' : 'post' }}">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" id="name"
                                   value="{{isset($product->name) ? $product->name : old('name')}}">

                        </div>
                        <div class="col-md-4">
                            <label for="brand">Marca</label>
                            <input class="form-control" type="text" name="brand" id="brand"
                                   value="{{isset($product->brand) ? $product->brand : old('brand')}}">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price">Preço</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price"
                                   value="{{isset($product->price) ? $product->price : old('price')}}">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="stock">Estoque</label>
                            <input type="number" class="form-control " name="stock" id="stock"
                                   value="{{isset($product->stock) ? $product->stock : old('stock')}}">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
