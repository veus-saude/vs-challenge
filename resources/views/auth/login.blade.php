@extends('auth.template.index')

@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset("Auth-Panel/assets/images/background/login-register.jpg") }});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material form-action" id="loginform" method="post" action="{{ route("login") }}">
                        @csrf
                        <h3 class="text-center m-b-20">
                            <img src="{{ asset("assets/img/logo.png") }}" alt="homepage" class="dark-logo " />
                        </h3>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label for="cpf"></label>
                                <input class="form-control cpf @error('cpf') is-invalid @enderror" type="text" name="cpf" id="cpf"  placeholder="Digite seu cpf..." value="{{ old("cpf") }}">
                            </div>
                            @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="password"></label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password"  placeholder="Digite sua senha...">
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Lembrar-me</label>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route("register") }}" id="to-recover" class="text-muted"><i class="fas fa-user-plus m-r-5"></i> Não sou Cadastrado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded btn-theme" type="submit">Acessar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
