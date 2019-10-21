@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                    <form action="/products" method="POST">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="form">
                            <div class="form-group">
                                <label>Nome</label>
                                <input name="nome" class="form-control" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label>Marca</label>
                                <input name="marca" class="form-control" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label>Preço</label>
                                <input name="preco" class="form-control" type="number" required/>
                            </div>
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input name="quantidade" class="form-control" type="number" required/>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="Submit">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    

@endsection