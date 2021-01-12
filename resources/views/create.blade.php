@extends('templates.template')
@section('content')
    <h1 class="text-center">@if(isset($produto))Editar @else Cadastrar @endif</h1>
    <hr>

    <div class="col-8 m-auto">
        @if(isset($errors) && count($errors)>0)
            <div class="text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}<br>
                @endforeach
            </div>
        @endif


        @if(isset($produto))
            <form name="formEdit" id="formEdit" method="post" action="{{url("/api/produtos/$produto->id")}}">
                @method('PUT')
        @else
            <form name="formCad" id="formCad" method="post" action="{{url('/api/produtos')}}">
        @endif
            @csrf
            <input class="form-control mb-2" type="text" name="name" id="name" placeholder="Nome" value="{{$produto->name ?? ''}}" required/>
            <input class="form-control mb-2" type="text" name="brand" id="brand" placeholder="Marca" value="{{$produto->brand ?? ''}}"required/>
            <input class="form-control mb-2" type="text" name="price" id="price" placeholder="Preço" value="{{$produto->price ?? ''}}" required />
            <input class="form-control mb-2" type="text" name="quantity" id="quantity" placeholder="Quantidade" value="{{$produto->quantity ?? ''}}" required/>
            <input class="btn btn-success btn-sm" type="submit" value="@if(isset($produto))Editar @else Cadastrar @endif"/>
            <a href="{{url("api/produtos")}}">
                <button type="button" class="btn btn-success btn-sm">Voltar</button>
            </a><br>

        </form>
    </div>
@endsection
