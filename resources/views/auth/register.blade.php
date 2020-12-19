@extends('auth.template.index')

@section('content')
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{ asset("Auth-Panel/assets/images/background/login-register.jpg") }});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material form-action" id="loginform" method="post" action="{{ route("register") }}">
                        @csrf
                        <h3 class="text-center m-b-20">
                            <img src="{{ asset("assets/img/logo.png") }}" alt="homepage" class="dark-logo " />
                        </h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label for="first_name"></label>
                                <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name"  placeholder="Digite seu Primeiro Nome..." value="{{ old("first_name") }}">
                            </div>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label for="last_name"></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name"  placeholder="Digite seu Sobrenome..." value="{{ old("last_name") }}">
                            </div>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label for="email"></label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email"  placeholder="Digite seu Melhor E-mail..." value="{{ old("email") }}">
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="password_confirmation"></label>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"  placeholder="Repita sua senha...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="use_api"></label>
                                <select class="form-control" name="use_api" id="use_api">
                                    <option value="0">Você fará uso da API?</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input @error('password') is-invalid-checkbox @enderror" id="terms" name="terms">
                                        <label class="custom-control-label @error('password') is-invalid-checkbox @enderror" for="terms"><a href="#">Aceitar Termos</a></label>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route("login") }}" id="to-recover" class="text-muted"><i class="fas fa-user-circle m-r-5"></i> Já sou Cadastrado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded btn-theme" type="submit">Registrar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
