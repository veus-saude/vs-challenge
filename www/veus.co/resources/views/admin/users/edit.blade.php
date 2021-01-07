@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.users.index') }}" title="Go back"> <i class="fa fa-backward ">Back</i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Atenção!</strong> Revise as informações preenchidas.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <input type="text" name="name" placeholder="Name"   class="form-control mb-2" value="{{ old('name') ?? $user->name ?? '' }}"/>
            <input type="text" name="email" placeholder="E-mail"   class="form-control col-12 mb-2" value="{{ old('email') ?? $user->email ?? ""  }}"/>
            <input type="text" name="password" placeholder="Password"   class="form-control col-6 mb-2" value=""/>
            <input type="text" name="password_confirmation" placeholder="Password Confirmation"   class="form-control col-6 mb-2" value=""/>



            <select name="status" id="status" class="form-control mb-2">
                <option value="2" {{ (old() ? old('status', 2) : ($user->status ?? -2) == 2 ) ? 'selected' : '' }}>Admin</option>
                <option value="1" {{ (old() ? old('status', 1) : ($user->status ?? -1) == 1 ) ? 'selected' : '' }}>Usuário</option>
                <option value="0" {{ (old() ? old('status', 0) : ($user->status ?? -1) == 0 ) ? 'selected' : '' }}>Inativa</option>
            </select>

        </div>
        <div class="row">
        <div class="col-6">

            <button type="submit" class="btn btn-primary" value="Enviar">Enviar</button>
        </div>

        <div class="col-6">
            <button type="reset" class="btn btn-light" value="Cancelar">Cancelar</button>
        </div>
        </div>

    </form>
</div>
@endsection
