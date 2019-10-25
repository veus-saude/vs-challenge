@extends('produto')

@section('content')

<h5 class="text-center mb-4">Editar Produtos ({{$produtoAtualizar->nome}})</h5>

<p>
    <a class="btn btn-outline-primary btn-sm" href="{{ url('painel') }}"><i class="fa fa-plus"></i> Listar Produto</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-produto-inativo')}}"><i class="fa fa-plus"></i> Produto Inativo</a>
    <a class="btn btn-outline-primary btn-sm" href="{{route('index-log')}}"><i class="fa fa-plus"></i> Log do Sistema</a>
</p>


            <!--Alert produto editado-->
            <div class="row">
                <div class="col-sm-6">
                    @if(session('update'))
                        <div class="alert alert-success mt-3">
                            {{session('update')}}
                        </div>
                    @endif
                </div>
            </div>
            <!--Alert produto editado-->

<div class="row">
    
        <!-- Inicio do formulário-->
        <div class="col md-5">
            
            <form action="{{route('update', Crypt::encrypt($produtoAtualizar->id))}}" method="POST">
                
                @csrf
                
                <div class="row">
                    <div class="col-sm-6">
                    
                        <div class="form-group">
                            <input type="text" name="nome" id="nome" value="{{$produtoAtualizar->nome}}" class="form-control" placeholder="Informe o nome do produto" required>
                        </div>
                        
                    </div>
                </div>

                
                
                <div class="row">
                    <div class="col-sm-6">
                
                        <div class="form-group">
                            <input type="text" name="marca" id="marca" value="{{$produtoAtualizar->marca}}" class="form-control" placeholder="Informe a marca.">
                        </div>
                        
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-sm-6">
                
                        <div class="form-group">
                            <input type="text" name="preco" id="preco" value="{{$produtoAtualizar->preco}}" class="form-control" placeholder="Informe o preço. Digitar somente numeros!" required>
                        </div>
                        
                    </div>
                </div>
                                
                
                <div class="row">
                    <div class="col-sm-6">
                
                        <div class="form-group">
                            <input type="text" name="quantidade" id="quantidade" value="{{$produtoAtualizar->quantidade}}" class="form-control" placeholder="Informe a quantidade. Digitar somente numeros!">
                        </div>
                        
                    </div>
                </div>
                              
                
                <div class="row">
                    <div class="col-sm-6">
                
                        <button type="submit" class="btn btn-warning btn-block btn-sm">Editar</button>
                        
                        <a class="btn btn-primary btn-block btn-sm" href="<?php echo URL::previous(); ?>"><i class="fa fa-plus"></i> Voltar</a>
                        
                    </div>
                </div>
                
                
            </form>

            

        </div>
        <!-- Inicio do formulário-->
</div>
    
@endsection