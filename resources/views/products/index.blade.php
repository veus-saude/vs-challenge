@extends('layouts.app')

@section('content')
<div class="container mt-2 mb-4">
    <h2 class="mb-4"><i class="fa fa-archive"></i> Produtos (<small>{{ $products->count() }}</small>)</h2>
    
    <a href="{{ route('products.create') }}" class="btn btn-primary text-white mb-4">
        <i class="fa fa-plus"></i> Novo Produto
    </a>
    
    <a href="#" class="btn btn-danger mb-4 delete-selected" data-url="{{ route('products.destroy-selected') }}" data-token="{{ csrf_token() }}" style="display: none;">
        <i class="fa fa-trash"></i> Excluir Selecionados
    </a>
    
    <div class="table-responsive py-1 pr-1">
        <table class="table table-bordered table-sm" id="dataTable">
            <thead class="bg-info text-white">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Data Aquisição</th>
                    <th>Ações</th>
                    <th class="text-center">
                        <input type="checkbox" id="check-uncheck" style="margin-left: 13px;" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>R$ <span class="maskMoney">{{ $product->price }}</span></td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ date('d/m/Y', strtotime($product->created_at)) }}</td>
                    <td class="text-center">
                        <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info btn-sm text-white" title="Editar"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td class="checkbox-clients text-center">
                        <input type="checkbox" class="check" name="products[]" value="{{ $product->id }}" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

