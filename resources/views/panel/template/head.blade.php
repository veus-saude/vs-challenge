<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">


    <link rel="icon" href="{{ asset("assets/img/favicon.ico") }}" sizes="32x32" />
    <link rel="icon" href="{{ asset("assets/img/favicon.ico") }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset("assets/img/favicon.ico") }}" />
    <meta name="msapplication-TileImage" content="{{ asset("assets/img/favicon.ico") }}" />

    <title>{{ $routeCurrent->wheres["label_permission"] ?? env("APP_NAME") }}</title>
    <link href="{{ asset("Auth-Panel/assets/node_modules/sweetalert2/dist/sweetalert2.min.css") }}" rel="stylesheet">
    <link href="{{ asset("Auth-Panel/dist/css/pages/ecommerce.css") }}" rel="stylesheet">
    <link href="{{ asset("Auth-Panel/dist/css/style.min.css") }}" rel="stylesheet">
    <link href="{{ asset("Auth-Panel/dist/css/custom.css") }}" rel="stylesheet">
    <style>
        @import url({{ asset("Auth-Panel/assets/icons/font-awesome/css/fontawesome-all.css") }});
        @import url({{ asset("Auth-Panel/assets/icons/simple-line-icons/css/simple-line-icons.css") }});
        @import url({{ asset("Auth-Panel/assets/icons/weather-icons/css/weather-icons.min.css") }});
        @import url({{ asset("Auth-Panel/assets/icons/themify-icons/themify-icons.css") }});
        @import url({{ asset("Auth-Panel/assets/icons/flag-icon-css/flag-icon.min.css") }});
        @import url({{ asset("Auth-Panel/assets/icons/material-design-iconic-font/css/materialdesignicons.min.css") }});
        @import url(https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700);
    </style>
    @if(isset($routeAmbient) && isset($routeCrud) && isset($routeMethod))
        @includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.head")
    @endif

    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
