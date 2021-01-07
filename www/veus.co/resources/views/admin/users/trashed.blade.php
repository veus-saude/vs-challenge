@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Apagadas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}" title="Nova User"> <i class="fa fa-plus-circle"></i>
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
        @foreach($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{$user->titulo}}</td>
            <td>{{$user->descricao}}</td>
            <td>{{$user->getStatusText()}}</td>
            <td>{{\Carbon\Carbon::parse($user->data_inicial)->diffForHumans()}}</td>
            <td>{{\Carbon\Carbon::parse($user->data_final)->diffForHumans()}}</td>
            <td>{{ date_format($user->created_at, 'jS M Y') }}</td>
            <td>
                <form action="{{ route('users.forcedelete', $user->id) }}" method="POST">

                    <a href="{{ route('users.show', $user->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg"></i>
                    </a>

                    <a href="{{ route('users.restore', $user->id) }}">
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

    {!! $users->links() !!}
</div>
@endsection


