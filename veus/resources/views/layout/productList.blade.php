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
                        <div class="form-group col-md-4">
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
                            <select name="price">
                                <option value="">Selecione...</option>
                                <option value="=">Igual</option>
                                <option value=">">Maior</option>
                                <option value="<">Menor</option>
                                <option value=">=">Maior ou igual</option>
                                <option value="<=">Menor ou igual</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="stock">Estoque</label>
                            <select name="stock">
                                <option value="">Selecione...</option>
                                <option value="=">Igual</option>
                                <option value=">">Maior</option>
                                <option value="<">Menor</option>
                                <option value=">=">Maior ou igual</option>
                                <option value="<=">Menor ou igual</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <div class="form-row">
                    <div class="form-group col">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
