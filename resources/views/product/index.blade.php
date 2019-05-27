@extends('default')

@section('title_user', 'Gerenciador de Produtos')

@section('header_user')
    <h1>Gerenciador de Produtos</h1>
@stop

@section('content_user')
    <table id="product" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Editar</th>
                <th>Remover</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{$product->product_id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->product_brand}}</td>
                <td>{{$product->product_price}}</td>
                <td>{{$product->product_qty}}</td>
                <td><a href="edit/{{$product->product_id}}">Editar</a></td>
                <td><a href="delete/{{$product->product_id}}">Remover</a></td>
            </tr>
            @endforeach
        </thead>
    </table>
@stop

@push('js')
<script>
$(document).ready(function() {
    $('#product').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
} );
</script>
@endpush