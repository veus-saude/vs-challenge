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

<script>
    function formSubmit(element)
    {
        event.preventDefault();
        // Inputs--------------------------------------------------------------------------
        $(element).find("input").parent("div").removeClass("has-danger");
        $(element).find("input").parent("div").addClass("has-success");
        $(element).find("input").parent("div").find("small").text("Validação Passou!");
        // Textarea------------------------------------------------------------------------
        $(element).find("textarea").parent("div").removeClass("has-danger");
        $(element).find("textarea").parent("div").addClass("has-success");
        $(element).find("textarea").parent("div").find("small").text("Validação Passou!");
        // Select--------------------------------------------------------------------------
        $(element).find("select").parent("div").removeClass("has-danger");
        $(element).find("select").parent("div").addClass("has-success");
        $(element).find("select").parent("div").find("small").text("Validação Passou!");
        $.ajax({
            url          : $(element).attr("action"),
            type         : $(element).attr("method"),
            dataType     : "JSON",
            data         : new FormData(element),
            processData  : false,
            contentType  : false,
            success : function (response) {
                if(response.status==="success")
                {
                    Swal.fire({
                        title : "Sucesso!",
                        text  : response.message,
                        type  : "success",
                        timer : 2000,
                        showConfirmButton: false
                    });
                    location.href = "{{ route("panel.product.index") }}";
                }
                else
                {
                    Swal.fire({
                        title : "Error!",
                        text  : response.message,
                        type  : "error",
                        timer : false,
                        showConfirmButton: true
                    });
                }
            },
            error : function (response) {
                if(response.responseJSON)
                {
                    console.log(response.responseJSON.data);
                    Swal.fire({
                        title : "Error!",
                        text  : response.responseJSON.message,
                        type  : "error",
                        timer : false,
                        showConfirmButton: true
                    });
                    $.each(response.responseJSON.data, function (index, value) {
                        // Inputs
                        var input = $(element).find("input[id="+index+"]");
                        if(input)
                        {
                            input.parent("div").addClass("has-danger");
                            input.parent("div").find("small").empty();
                            input.parent("div").find("small").text(value);
                        }
                        // Textarea
                        var textarea = $(element).find("textarea[id="+index+"]");
                        if(textarea)
                        {
                            textarea.parent("div").addClass("has-danger");
                            textarea.parent("div").find("small").empty();
                            textarea.parent("div").find("small").text(value);
                        }
                        // Select
                        var select = $(element).find("select[id="+index+"]");
                        if(select)
                        {
                            select.parent("div").addClass("has-danger");
                            select.parent("div").find("small").empty();
                            select.parent("div").find("small").text(value);
                        }
                    });
                }
                else
                {
                    Swal.fire({
                        title : "Error!",
                        text  : response,
                        type  : "error",
                        timer : false,
                        showConfirmButton: true
                    });
                }
            },
        });
    }
</script>

@stack('scripts')
