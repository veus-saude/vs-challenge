@extends('layouts.template_home')

@section('head')

@endsection

@section('header')
@endsection

@section('section1')
<section>
    <div class="container-fluid mt-0 HeaderHome">
        <div class="row">
            <div class="col-12 col-sm-6"></div>
            <div class="col-12 col-sm-6 contraste espver">
                <div class="row">
                    <div class="col text-right" style="padding-right: 30px;">
                        <span class="Hero">Atualize suas <span class="HeroStrong">credenciais</span> de acesso.</span><br />
                    </div>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}" />
                    <div class="form-group row">
                        <input type="email" class="InputHome text-center {{ $errors->has('email') ? ' is-invalid' : '' }}" style="width: 90%" id="E-mail" placeholder="Seu e-mail profissional"  name="email" value="{{ old('email') }}" required autofocus pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" title="Favor preencher corretamente o campo E-mail" aria-label="Seu e-mail profissional" required>

          @if ($errors->has('email'))
            <br />
            <span style="color:white; font-weight: bold;">
                {{$errors->first('email')}}
            </span>
          @endif
                    </div>
                    <div class="form-group row">
                        <input type="password" class="InputHome text-center {{ $errors->has('password') ? ' is-invalid' : '' }}" style="width: 90%" id="password" placeholder="Senha" name="password" required autofocus>
                        @if ($errors->has('password'))
                            <span style="color:white; font-weight: bold;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <input type="password" class="InputHome text-center" style="width: 90%" id="password-confirm" placeholder="Confirme sua Senha"  name="password_confirmation" value="" required>
                    </div>
                    <div class="row justify-content-md">
                        <button class="btn text-center myButton3" type="submit" style="width: 90%">
                            Cadastrar nova senha
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
@endsection

@section('script')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
@endsection
