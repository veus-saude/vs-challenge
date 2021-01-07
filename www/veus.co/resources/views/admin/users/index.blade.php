@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.users.create') }}" title="Nova User"> <i class="fa fa-plus-circle">New</i>
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
            <td>E-mail</td>
            <td>Status</td>

            <td width='280px'>Ações</td>
        </tr>
        @foreach($users as $user)
        <tr>

            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->getStatusText()}}</td>

            <td>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">

                    <a href="{{ route('admin.users.show', $user->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg">View</i>
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}">
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

    {!! $users->links("pagination::bootstrap-4") !!}
</div>
@endsection


