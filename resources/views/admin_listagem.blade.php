@extends('layouts.base')

@section('conteudo')

    <div class="container mt-4">

        @include('elementos.filtros')

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="table_produtos">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade em Estoque</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation" id="paginacao">
            <div class="page_load float-left"></div><ul class="pagination justify-content-end">
              {{-- <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li> --}}
            </ul>
        </nav>        
    </div>
    <script>
        function carregaProdutos (parametro) {
            $('.page_load').html('Carregando ...');
            instance.get('/products', {params: parametro})
            .then(function (response) {
                $('#table_produtos tbody').html('');
                $.each(response.data.data, function (index, value) {
                    linha_table = '';
                    linha_table += '<tr id="' + value.id + '"><td>' + value.nome + '</td>' +
                                    '<td>' + value.brand + '</td>' +
                                    '<td>' + value.preco + '</td>' +
                                    '<td>' + value.qtd_estoque + '</td>' +   
                                    '<td><a href="editar_produtos/' + value.id + '" target="_blank" class="btn btn-primary">Editar</a> ' +
                                    '<button type="button" class="btn btn-danger delete">Deletar</button></td></tr>';
                    $('#table_produtos tbody').append(linha_table);
                });
                montaPaginacao(response.data);
                $('.page_load').html('');
            })
            .catch(function (error) {
                if(error.response){
                    $('.page_load').html('');
                    if(error.response.status == 401){
                        alert('Acesso Negado');
                        window.location.href = "/login";
                    }     
                    if(error.response.status == 500){
                        alert('Erro tente novamente mais tarde');
                    }
                }
            })
        }

        function montaBusca () {
            busca = {}
            busca.sort = $('#ordenar').val();
            $('input').each( function () {
                valor = $(this).val();
                if(valor.trim() != ''){
                    campo_filtro = $(this).attr('id');
                    if($(this).attr('id') != 'q'){
                        busca.filter = (busca.filter && busca.filter.length > 0) ? busca.filter + ';' + campo_filtro + ':' + valor : campo_filtro + ':' + valor;
                    }else{
                        busca.q = $('#q').val();
                    }
                }
            });
            return busca;
        }
        $(document).ready(function () {
            const padrao = {page:1}
            carregaProdutos(padrao);

            $('#paginacao').on('click', '.page-link', function () {
                pagina = $(this).attr('id');
                busca = montaBusca();
                busca.page = pagina
                carregaProdutos(busca);
            });

            $('#table_produtos').on('click', '.delete', function(e) {
                e.preventDefault();
                produto_id = $(this).parents('tr').attr('id');
                instance.post('/products/' + produto_id, {_method:'delete'})
                .then(function (response) {
                    if(response.status == 204) {
                        carregaProdutos(padrao);
                    }
                })
                .catch(function (error) {
                    if(error.response){
                        if(error.response.status == 401){
                            alert('Acesso Negado');
                            window.location.href = "/login";
                        }     
                        if(error.response.status == 500){
                            alert('Erro tente novamente mais tarde');
                        }
                    }
                })
            });

            $('#buscar').on('click', function(e) {
                e.preventDefault();
                busca = montaBusca()
                carregaProdutos(busca)
            });            
        });
        </script>
@endsection