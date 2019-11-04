<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>VEUS - @yield('title')</title>
    </head>
    <body>
        <div class="container-fluid">
            @component('navbar')
            @endcomponent
            <main role="main">
                @hasSection('body')
                    @yield('body')
                @endif
            </main>
        </div>
    </body>
</html>
