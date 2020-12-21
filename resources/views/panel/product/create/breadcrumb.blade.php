<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">{{ $routeCurrent->wheres["label"] ?? "Sem Label na rota" }} {{ $routeCurrent->wheres["group"] ?? "Sem Group na rota" }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("$routeAmbient.main.index") }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route("$routeAmbient.$routeCrud.$routeMethod") }}">{{ $routeCurrent->wheres["label"] ?? "Sem Label na rota" }} {{ $routeCurrent->wheres["group"] ?? "Sem Group na rota" }}</a></li>
            </ol>
        </div>
    </div>
</div>
