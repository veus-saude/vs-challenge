<!DOCTYPE html>
<html lang="pt-BR">
    @includeIf("auth.template.head")
    <body>
        {{--@includeIf("auth.template.preloader")--}}
        @yield("content")
        @includeIf("auth.template.javascript")
    </body>
</html>
