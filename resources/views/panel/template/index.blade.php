<!DOCTYPE html>
<html lang="pt-BR">
    @includeIf("$routeAmbient.template.head")
    <body class="skin-default fixed-layout">
        @includeIf("$routeAmbient.template.preloader")
        <div id="main-wrapper">
            @includeIf("$routeAmbient.template.header")
            @includeIf("$routeAmbient.template.left-sidebar")
            <div class="page-wrapper">
                <div class="container-fluid">
                    @includeIf("$routeAmbient.$routeCrud.$routeMethod.breadcrumb")
                    @yield("content")
                </div>
            </div>
            @includeIf("$routeAmbient.template.footer")
        </div>
        @includeIf("$routeAmbient.template.javascript")
    </body>
</html>


