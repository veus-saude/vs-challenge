<!DOCTYPE html>
<html class="no-js" lang="pt-BR">
@includeIf("apiDocumentation.template.head")
<body>
@includeIf("apiDocumentation.template.left-sidebar")
<div class="content-page">
    <div class="content-code"></div>
    <div class="content">
        @includeIf("apiDocumentation.template.get-start")
        <!---------------------------------------------------->
        @yield("content")
        <!---------------------------------------------------->
        @includeIf("apiDocumentation.template.errors")
    </div>
    <div class="content-code"></div>
</div>
@includeIf("apiDocumentation.template.javascript")
</body>
</html>
