@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product</h2>
            </div>

        </div>
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">

                    <a href="{{ route('admin.products.show', $product->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg">Show</i>
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
            </div>
            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('admin.products.index') }}" title="Go back"> <i class="fa fa-backward ">Back</i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Review your information!.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div class="row">
    <div class="col-3">Name</div>
<div class="col-9">{{$product->name}}</div>
</div>
<div class="row">
    <div class="col-3">Brand</div>
<div class="col-9">{{$product->brand}}</div>
</div>

<div class="row">
    <div class="col-3">Price</div>
<div class="col-9">{{$product->price}}</div>
</div>


<div class="row">
    <div class="col-3">Quantity</div>
<div class="col-9">{{$product->qty}}</div>
</div>

@endsection
