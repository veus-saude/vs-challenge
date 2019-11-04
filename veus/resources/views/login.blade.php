@extends('layout.app')
@section('body')
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                <form action="login" method="post">
                    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email..." required autofocus>
                    <label for="password" class="sr-only">Senha</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
