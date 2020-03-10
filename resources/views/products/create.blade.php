@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4><i class="fa fa-archive"></i> Cadastro de Produtos</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" autocomplete="off">
                
                @csrf

                <div class="form-group form-row">
                    <div class="col-lg-6">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control {{ ($errors->has('name') ? 'is-invalid' : '') }}" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <label for="brand">Marca:</label>
                        <input type="text" class="form-control {{ ($errors->has('brand') ? 'is-invalid' : '') }}" id="brand" name="brand" value="{{ old('brand') }}">
                        @if ($errors->has('brand'))
                            <div class="invalid-feedback">
                                {{ $errors->first('brand') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group form-row">
                    <div class="col-lg-6">
                        <label for="price">Preço:</label>
                        <input type="text" class="form-control maskMoney {{ ($errors->has('price') ? 'is-invalid' : '') }}" id="price" name="price" value="{{ old('price') }}">
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <label for="quantity">Quantidade:</label>
                        <input type="number" class="form-control {{ ($errors->has('quantity') ? 'is-invalid' : '') }}" id="quantity" name="quantity" value="{{ old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <div class="invalid-feedback">
                                {{ $errors->first('quantity') }}
                            </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-white"><i class="fa fa-check-square-o"></i> Cadastrar Produto</button>
                <a href="{{ route('products.index') }}" class="btn btn-info text-white"><i class="fa fa-reply"></i> Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection