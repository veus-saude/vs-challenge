<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/axios_interceptor.js')}}"></script>
        <script src="{{ asset('js/shared.js')}}"></script>
        <style>
            body,html{
                height:100%;
            }   
        </style>
    </head>
    <body>
        @if (Route::current()->uri() != 'login' && Route::current()->uri() != 'site')
            @include('navbar')
        @endif

            
        @yield('conteudo')
            
    </body>
</html>
