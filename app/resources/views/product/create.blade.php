@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cadastrar Produto</div>
                <div class="card-body">
                <form method="post" action="{{ route('produtos.store') }}">
                @csrf
                    <div class="form-group">
                        <label>Nome:</label> 
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Informe o nome do produto">  
                        @if ($errors->has('name'))                        
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Marca:</label>
                        @include('partials.cb_brandById')
                       
                        @if ($errors->has('brand'))                        
                            <span class="text-danger">
                                <strong>{{ $errors->first('brand') }}</strong>
                            </span>
                        @endif 
                    </div>

                    <div class="form-group">
                        <label>Preço:</label>
                        <input type="text" class="form-control money" name="price" value="{{ old('price') }}" placeholder="Informe o preço do produto">  
                        @if ($errors->has('price'))                        
                            <span class="text-danger">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Quantidade:</label>
                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" placeholder="Informe a quantidade do produto"> 
                        @if ($errors->has('quantity'))                        
                            <span class="text-danger">
                                <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                        @endif 
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Gravar</button>
                    <a href="/produtos" class="btn btn-link">Voltar</a>
                </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
