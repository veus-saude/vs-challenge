@extends("$routeAmbient.template.index")

@section("content")
    @includeIf("$routeAmbient.$routeCrud.$routeMethod.form")
@endsection
