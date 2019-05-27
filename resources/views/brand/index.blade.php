@extends('default')

@section('title_user', 'Gerenciador de Marcas')

@section('header_user')
    <h1>Gerenciador de Marcas</h1>
@stop

@section('content_user')
    <table id="brand" style="width:100%">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>            
            @foreach($brands as $brand)
            <tr>
                <td>{{$brand->brand_id}}</td>
                <td>{{$brand->brand_name}}</td>
                <td><a href="brand/edit/{{$brand->brand_id}}">Editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop

@push('js')
<script>
$(document).ready(function() {
    $('#brand').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
} );
</script>
@endpush