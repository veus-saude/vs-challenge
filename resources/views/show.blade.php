@extends('templates.template')
@section('content')
    <h1 class="text-center">Visualizar</h1>
    <hr>
    <div class=" text-center">
        <a href="{{url("api/produtos")}}">
            <button type="button" class="btn btn-success btn-sm mb-3">Voltar</button>
        </a><br>
        Nome: {{$produto->name}}<br>
        Marca: {{$produto->brand}}<br>
        Preço: R${{$produto->price}}<br>
        Quantidade: {{$produto->quantity}}<br>
    </div>

@endsection
