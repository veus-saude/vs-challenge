<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Veus Technology</title>

        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!-- DataTables CSS -->
        <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="wrapper">
            <div id="page-wrapper">
                <div class="container-fluid">
                @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- DataTables JavaScript -->
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
        @yield('js')

    </body>
</html>
