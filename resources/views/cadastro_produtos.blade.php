@extends('layouts.base')

@section('conteudo')

<div class="container">
    <div class="col col-xs-12 col-sm-12 mx-auto mt-5">
        <div class="card">
            <h5 class="card-header">Cadastro de Produtos</h5>
            <div class="card-body">
                <div class="resultado"></div>
                <form id="formProduto">
                    <div class="form-group">
                        <label for="inputEmail4">Nome</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Marca:</label>
                        <input type="text" class="form-control" id="brand" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Quantidade em Estoque</label>
                        <input type="number" class="form-control" id="qtd_estoque" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Preço</label>
                        <input type="text" class="form-control" id="preco" placeholder="" required>
                    </div>    
                    <button type="submit" class="btn btn-primary" id="cadastrar">Cadastrar</button>
                    <a href="{{route('admin_listagem')}}" class="btn btn-success">Listagem de Produtos</a>
                </form>
            </div>
        </div>
    </div>                
</div>
<script>
$(document).ready(function () {
    $('#formProduto').submit(function(e) {
        e.preventDefault();
        let dados = {}
        $('#formProduto input').each(function () {
            id = $(this).attr('id');
            valor = $(this).val();
            dados[id] = valor
        })
        $('#cadastrar').prop('disabled',true).html('Carregando ...');
        instance.post('/products', dados)
        .then(function (response) {
            $('#cadastrar').prop('disabled', false).html('Cadastrar');
            $('.resultado').html('<div class="alert alert-success" role="alert"> Cadastrado com suceso</div>');
            $('#formProduto')[0].reset();
        })
        .catch(function (error) {
            if(error.response){
                if(error.response.status == 401){
                    alert('Acesso Negado');
                    $('.resultado').html('<div class="alert alert-danger" role="alert">Erro ao cadastrar</div>');
                }
                if(error.response.status == 422){
                    alert('Verifique os campos obrigatorios');
                    $('.resultado').html('<div class="alert alert-danger" role="alert">Erro ao cadastrar</div>');
                }            
                if(error.response.status == 500){
                    alert('Erro tente novamente mais tarde');
                    $('.resultado').html('<div class="alert alert-danger" role="alert">Erro ao cadastrar</div>');
                }
            }                    
            $('#cadastrar').prop('disabled', false).html('Cadastrar');
        })                  
    });
  
});
</script>
@endsection    