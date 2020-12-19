<script src="{{ asset("Auth-Panel/assets/node_modules/jquery/jquery-3.2.1.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/popper/popper.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/perfect-scrollbar.jquery.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/waves.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/sidebarmenu.js") }}"></script>
<script src="{{ asset("Auth-Panel/dist/js/custom.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js") }}"></script>
<script src="{{ asset('jquery.mask.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
</script>

@includeIf("Global.masks")
@includeIf("Global.via_cep")
@includeIf("Global.sweetalert")

@if(isset($routeAmbient) && isset($routeCrud) && isset($routeMethod))
    @includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.javascript")
@endif

<script>
    $(document).ready(function () {
        @if(env("APP_ENV")!="local")
            window.history.forward(1);
        @endif


        $(".custom-file-input").on("change", function() {
            let fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>

@stack('scripts')
