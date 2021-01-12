@extends('templates.template')
@section('content')
    <h1 class="text-center">Produtos</h1>
    <hr>
    <div class="text-center mb-3">
        <a href="{{url('api/produtos/create')}}">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>
    <div class="col-8 m-auto">
        @csrf
        <table class="table table-striped table-hover text-center">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Marca</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($produto as $produtos)
                <tr>
                    <th scope="row">{{$produtos->id}}</th>
                    <td>{{$produtos->name}}</td>
                    <td>{{$produtos->brand}}</td>
                    <td>{{$produtos->price}}</td>
                    <td>{{$produtos->quantity}}</td>
                    <td>
                        <a href="{{url("api/produtos/$produtos->id")}}">
                            <button type="button" class="btn btn-info btn-sm">Visualizar</button>
                        </a>
                        <a href="{{url("api/produtos/$produtos->id/edit")}}">
                            <button type="button" class="btn btn-warning btn-sm">Editar</button>
                        </a>
                        <a href="{{url("api/produtos/$produtos->id")}}" class="js-del">
                            <button type="button" class="btn btn-danger btn-sm">Excluir</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
    <div class="d-flex justify-content-center">
        {{$produto->links()}}
    </div>
@endsection
