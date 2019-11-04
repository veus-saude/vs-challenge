@extends('layout.app')
@section('body')
    <div class="container">
        <div class="card">
            <div class="text-center mt-3">
                <h2>Cadastro de Produtos</h2>
            </div>
            <div class="card-body">
                <form action="/products" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="col-md-4">
                            <label for="brand">Marca</label>
                            <input class="form-control" type="text" name="brand" id="brand">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price">Preço</label>
                            <input type="number" step="0.00" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="stock">Estoque</label>
                            <input type="number" class="form-control" name="stock" id="stock">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
