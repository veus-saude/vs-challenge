@extends('layouts.template_home')

@section('head')

@endsection

@section('header')
@endsection

@section('section1')
<section>
    <div class="container-fluid mt-0 HeaderHome">
        <div class="row">
            <div class="col-12 col-sm-6">
            </div>
            <div class="col-12 col-sm-6 contraste espver">
                <div class="row">
                    <div class="col text-right" style="padding-right: 30px;">
                        <span class="Hero">Informe seu <span class="HeroStrong">e-mail</span> para receber um <span class="HeroStrong"> link</span> de recuperação de senha.</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 espver2 text-sm-right text-center" style="padding-right: 30px;">
                            <input type="email" class="InputHome text-center {{ $errors->has('email') ? ' is-invalid' : '' }}" style="width: 90%" id="E-mail" placeholder="Seu e-mail profissional"  name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-sm-right text-center" style="margin-top: 15px; padding-right: 30px; width: 90%">
                            <button class="btn text-center myButton3" style="width: 90%;" type="submit" onclick="verificar_email()">
                                &nbsp;&nbsp;Enviar link de recuperação de senha&nbsp;&nbsp;
                            </button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 text-sm-right text-center" style="margin-top: 15px; padding-bottom: 15px; padding-right: 30px; width: 90%">
                        <p style="font-weight: 500;">
                        Você receberá um email com um link para recuperação de senha.</p>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')
@endsection

@section('script')
    @if($errors->has('email'))
        <script>
            alert("Não encontramos seu email em nossa base de dados.");
        </script>
        @else
        <script>
        function verificar_email() {
            alert("Verifique seu email para redefinir a senha.");
            window.location.href("http://localhost:8000/login");
          }
        </script>
    @endif
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
@endsection
