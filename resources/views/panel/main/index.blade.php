@extends("$routeAmbient.template.index")

@section("content")
    @includeIf("$routeAmbient.$routeCrud.$routeMethod.profiles.".tagear(firstRole()))
@endsection
