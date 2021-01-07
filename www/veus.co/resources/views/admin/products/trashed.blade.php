@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products Apagadas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}" title="Nova Product"> <i class="fa fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <td>Id</td>
            <td>Título</td>
            <td>Descrição</td>
            <td>Situação</td>
            <td>Data Inicial</td>
            <td>Data Final</td>
            <td>Data Criação</td>
            <td width='280px'>Ações</td>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{$product->titulo}}</td>
            <td>{{$product->descricao}}</td>
            <td>{{$product->getStatusText()}}</td>
            <td>{{\Carbon\Carbon::parse($product->data_inicial)->diffForHumans()}}</td>
            <td>{{\Carbon\Carbon::parse($product->data_final)->diffForHumans()}}</td>
            <td>{{ date_format($product->created_at, 'jS M Y') }}</td>
            <td>
                <form action="{{ route('products.forcedelete', $product->id) }}" method="POST">

                    <a href="{{ route('products.show', $product->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg"></i>
                    </a>

                    <a href="{{ route('products.restore', $product->id) }}">
                        <i class="fa fa-pencil  fa-lg"></i>

                    </a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" title="apagar" style="border: none; background-color:transparent;">
                        <i class="fa fa-trash fa-lg text-danger"></i>

                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $products->links() !!}
</div>
@endsection


