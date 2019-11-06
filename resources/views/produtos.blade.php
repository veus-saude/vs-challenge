@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('produtos.index') }}">
                    <label>Pesquisa por nome:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="brand" value="{{ request('marca') }}"
                               placeholder="Marca">
                        <input type="text" class="form-control" name="q" value="{{ request('nome') }}"
                               placeholder="Nome">
                        <button class="btn btn-success" type="submit">Pesquisar</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6">Ordenar:
                        <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => request('sortBy'), 'direction' => 'asc', 'filter' => request('filter')]) }}"
                           class="btn btn-link">Ascendente</a>
                        <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => request('sortBy'), 'direction' => 'desc', 'filter' => request('filter')]) }}"
                           class="btn btn-link">Descendente</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('produtos.index') }}" class="btn btn-block btn-primary">Limpar Filtros</a>
                    </div>
                </div>
                <table class="table table-striped mt-4">
                    <thead>
                    <tr>
                        <th>
                            <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => 'nome', 'direction' => request('direction') ?? 'asc', 'filter' => request('filter')]) }}"
                               class="btn btn-link">Nome <i class="fa fa-sort-amount-{{ request('direction') ?? 'asc' }}"></i></a>
                        </th>
                        <th>
                            <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => 'marca', 'direction' => request('direction') ?? 'asc', 'filter' => request('filter')]) }}"
                               class="btn btn-link">Marca <i class="fa fa-sort-amount-{{ request('direction') ?? 'asc' }}"></i></a>
                        </th>
                        <th>
                            <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => 'preco', 'direction' => request('direction') ?? 'asc', 'filter' => request('filter')]) }}"
                               class="btn btn-link">Preço <i class="fa fa-sort-amount-{{ request('direction') ?? 'asc' }}"></i></a>
                        </th>
                        <th>
                            <a href="{{ route('produtos.index', ['q' => request('q'), 'sortBy' => 'preco', 'direction' => request('direction') ?? 'asc', 'filter' => request('filter')]) }}"
                               class="btn btn-link">Quantidade em Estoque <i class="fa fa-sort-amount-{{ request('direction') ?? 'asc' }}"></i></a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->marca }}</td>
                            <td>{{ number_format($produto->preco, 2, ',', '.') }}</td>
                            <td>{{ $produto->quantidade }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $produtos->links() }}
            </div>
        </div>
    </div>
@endsection
