<!doctype html>
<html lang="pt-br">
    <head>
        @yield('head')
        <meta charset="UTF-8">
        <meta name="author" content="Miguel Walquirio Diniz Machado">
        <meta name="description" content="Desafio Veus">
        <meta name="abstract" content="Desafio Veus">
        <meta name="keywords" content="desafio, veus, desafio veus">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="theme-color" content="#ff9933">
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
        <script src="{{asset('js/jquery.mask.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700,800,500" rel="stylesheet">

        <link rel="canonical" href="http://localhost:8000/" />
        <link rel="publisher" href="http://localhost:8000/" />

    </head>

  <body>
    <!-- header e section da página home -->
    @yield('header')
    <!-- Header -->
    <!-- <header class="navbar-fixed-top"> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ route('home') }}">VEUS - Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{url('cadastro')}}">Cadastre-se</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('login')}}">Login</a>
          </li>
          @else
          @php
            $nuser = explode(" ", Auth::user()->name);
            $nuser = $nuser[0];
          @endphp
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <small class="text-center">
                <i class="fas fa-user mr-2 text-center"></i>{{ucwords(mb_strtolower($nuser, 'UTF-8'))}} - {{ucwords(Auth::user()->type[0]['type'])}}</small>
            </a>
            <div class="dropdown-menu dropdown-dark bg-dark" aria-labelledby="navbarDropdown">
              <a class="nav-link dropdown-item dropdown-dark bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form></a>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </nav>

  <!-- </header> -->

@yield('section1')

@yield('footer')
  <!-- Footer -->

@yield('script')
  <!-- Scripts -->

  </body>
</html>
