@extends('produto')

@section('content')

<h5 class="text-center mb-4">Cadastrar Produto</h5>

<p>
    <a class="btn btn-outline-primary btn-sm" href="{{route('painel')}}"><i class="fa fa-plus"></i> Listar Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-produto-inativo')}}"><i class="fa fa-plus"></i> Produto Inativo</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>

    <!--Alert produto cadastrado-->
    <div class="row">
        <div class="col-sm-6">
            @if(session('agregar'))
                <div class="alert alert-success mt-3">
                    {{session('agregar')}}
                </div>
            @endif
        </div>
    </div>    
    <!--Alert produto cadastrado--> 
    
<div class="row">
        
        <!-- Inicio do formulário-->
        <div class="col md-5">
            
            <form action="{{route('store')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <input type="text" name="nome" id="nome" value="{{old('nome')}}" class="form-control" placeholder="Informe o nome do produto." required>
                        </div>
                        
                    </div>
                </div>
                
                
                <!--Satus validação error-->
                @error('nome')
                <div class="alert alert-danger mt-3">
                    O campo nome é obrigatório.
                </div>
                @enderror
                     
                <div class="row">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <input type="text" name="marca" id="marca" value="{{old('marca')}}" class="form-control" placeholder="Informe a marca.">
                        </div>
                        
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <input type="text" name="preco" id="preco" value="{{old('preco')}}" class="form-control" placeholder="Informe o preço. Digitar somente numeros!" required>
                        </div>
                        
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-sm-6">
                        <!--Satus validação error-->
                        @error('preco')
                        <div class="alert alert-danger mt-3">
                            O campo nome é obrigatório.
                        </div>
                        @enderror
                    </div>     
                </div>
                
                
                <div class="row">
                    <div class="col-sm-6">
                
                        <div class="form-group">
                            <input type="text" name="quantidade" id="quantidade" value="{{old('quantidade')}}" class="form-control" placeholder="Informe a quantidade. Digitar somente numeros!">
                        </div>
                        
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-sm-6">
                    
                        <button type="submit" class="btn btn-success btn-block btn-sm">Inserir</button>
                
                        <a class="btn btn-primary btn-block btn-sm" href="<?php echo URL::previous(); ?>"><i class="fa fa-plus"></i> Voltar</a>
                        
                    </div>
                </div>
                
                
            </form>
            
            
        </div>
        <!-- Inicio do formulário-->
</div>
    
@endsection