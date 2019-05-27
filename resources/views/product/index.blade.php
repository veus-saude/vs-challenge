@extends('default')

@section('title_user', 'Gerenciador de Produtos')

@section('header_user')
    <h1>Gerenciador de Produtos</h1>
@stop

@section('content_user')
    <table id="product" style="width:100%">
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
        </thead>
        <tbody>            
            @foreach($products as $product)
            <tr>
                <td>{{$product->product_id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->brand->brand_name}}</td>
                <td>{{$product->product_price}}</td>
                <td>{{$product->product_qty}}</td>
                <td><a href="edit/{{$product->product_id}}">Editar</a></td>
                <td><form method="post" action="delete/{{$product->product_id}}">@csrf<button type="submit">Remover</button></form></td>
            </tr>
            @endforeach
        </tbody>
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