@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User</h2>
            </div>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">

                    <a href="{{ route('admin.users.show', $user->id) }}" title="show">
                        <i class="fa fa-eye text-success  fa-lg"></i>
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}">
                        <i class="fa fa-pencil  fa-lg"></i>
                    </a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" title="apagar" style="border: none; background-color:transparent;">
                        <i class="fa fa-trash fa-lg text-danger"></i>
                    </button>
                </form>
            </div>
            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('admin.users.index') }}" title="Go back"> <i class="fa fa-backward ">Back</i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Please review your information.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div class="row">
    <div class="col-3">Name</div>
<div class="col-9">{{$user->name}}</div>
</div>
<div class="row">
    <div class="col-3">E-mail</div>
<div class="col-9">{{$user->email}}</div>
</div>

<div class="row">
    <div class="col-3">Status</div>
<div class="col-9">{{$user->getStatusText()}}</div>
</div>
</div>
@endsection
