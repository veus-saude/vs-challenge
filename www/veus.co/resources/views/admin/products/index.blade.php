@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products </h2>
            </div>
            <div class="pull-right">
                <form method="GET" action="/admin/products">
                 <div class="input-group mb-3">
                     <input type="text" class="form-control" name="q" placeholder="search" aria-label="search" aria-describedby="search">
                     <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="cancel">Clean</button>
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                     </div>
                   </div>
                </form>
             </div>
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="{{ route('admin.products.create') }}" title="Nova Product"> <i class="fa fa-plus-circle">New</i>
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

            <td>Name</td>
            <td>Brand</td>
            <td>Qty</td>
            <td>Price</td>
            <td width='280px'>Actions</td>
        </tr>
        @foreach($products as $product)
        <tr>

            <td>{{$product->name}}</td>
            <td>{{$product->brand}}</td>
            <td>{{$product->qty}}</td>
            <td>{{$product->price}}</td>

            <td>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">

                    <a href="{{ route('admin.products.show', $product->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg">View</i>
                    </a>

                    <a href="{{ route('admin.products.edit', $product->id) }}">
                        <i class="fa fa-pencil  fa-lg">Edit</i>

                    </a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" title="apagar" style="border: none; background-color:transparent;">
                        <i class="fa fa-trash fa-lg text-danger">Delete</i>

                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
<div class="links-paginacao">
    {!! $products->links("pagination::bootstrap-4") !!}

</div>
</div>
@endsection


