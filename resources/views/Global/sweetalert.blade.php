<script src="{{ asset("Auth-Panel/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js") }}"></script>
<script>
    !function ($) {
        "use strict";
        var SweetAlert = function () { };
        SweetAlert.prototype.init = function () {
            //Success Message
            @if(session('success'))
            Swal.fire({
                title :"Parabéns",
                text :"{{ session('success') }}",
                type :"success",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Error Message
            @if(session('error') && !session('errors'))
            Swal.fire({
                title :"Ops!",
                text :"{{ session('error') }}",
                type :"error",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Error Message
            @if(session('error') && session('errors'))
            Swal.fire({
                title :"Ops!",
                text :"{{ session('error') }}",
                type :"error",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Errors Message
            @if(session('errors') && !session('error'))
            Swal.fire({
                title :"Ops!",
                text :"Erro ao executar a ação!",
                type :"error",
                timer: 2000,
                showConfirmButton: false
            });
            @endif
            //Warning Message
            @if(session('warning'))
            Swal.fire({
                title :"Alerta!",
                text :"{{ session('warning') }}",
                type :"warning",
                timer: 2000,
                showConfirmButton: false
            });
            @endif

            $.fn.registerEventPassparameter = function() {
                $(".sa-passparameter").click(function () {
                    var url = this.id;
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'mr-2 btn btn-danger'
                        },
                        buttonsStyling: false,
                    });
                    swalWithBootstrapButtons.fire({
                        title: 'Exclusão de item?',
                        text: "Deseja mesmo excluir esse item?!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, quero excluir!',
                        cancelButtonText: 'Não, cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax(url, {
                                method : "GET",
                                success: function(response) {
                                    if(response.code != '301')
                                    {
                                        swalWithBootstrapButtons.fire(
                                            'Deletado!' ,
                                            'Você deletou este item.' ,
                                            'success'
                                        );
                                        setTimeout( function() {
                                            location.reload();
                                        } , 1000 );
                                    }
                                    else
                                    {
                                        Swal.fire( "Sistema" , "Não Autorizado" , "error" );
                                    }
                                },
                                error:function(error) {
                                    if(error.responseJSON.message)
                                    {
                                        Swal.fire("Sistema", error.responseJSON.message, "error");
                                    }
                                    else
                                    {
                                        Swal.fire("Sistema", "Não foi possível deletar este item", "error");
                                    }
                                }
                            });
                        } else
                        {
                            if(
                                result.dismiss === Swal.DismissReason.cancel
                            )
                            {
                                swalWithBootstrapButtons.fire(
                                    'Cancelado' ,
                                    'você cancelou a exclusão :)' ,
                                    'error'
                                );
                                setTimeout( function() {
                                    location.reload();
                                } , 1000 );
                            }
                        }
                    })
                });
            }
            $('body').registerEventPassparameter();

            $('.click-action').click(function() {
                let timerInterval;
                Swal.fire({
                    title: 'Aguarde o processamento!',
                    html: 'O sistema está tentando realizar a ação.',
                    timer: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                        timerInterval = setInterval(() => {
                            //Swal.getContent().querySelector('strong')
                                //.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.timer
                    ) {
                        console.log('I was closed by the timer')
                    }
                })
            });

            $(".form-action").submit(function () {
                let timerInterval;
                Swal.fire({
                    title: 'Aguarde o processamento!',
                    html: 'O sistema está tentando realizar a ação.',
                    timer: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                        timerInterval = setInterval(() => {
                           //Swal.getContent().querySelector('strong')
                                //.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.timer
                    ) {
                        console.log('I was closed by the timer')
                    }
                })
            });
        },
            //init
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
    }(window.jQuery),

        //initializing
        function ($) {
            "use strict";
            $.SweetAlert.init()
        }(window.jQuery);

    $(document).keypress(function(e) {
        if(e.which == 13) $(".swal2-confirm").click();
    });

</script>

<script>
    function loadingSwal(title, message) {
        let timerInterval;
        Swal.fire({
            title: title,
            html: message,
            timer: false,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                }, 100)
            },
            onClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.timer
            ) {
                console.log('I was closed by the timer')
            }
        });
    }

    function successSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            type  : "success",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }

    function errorSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            type  : "error",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }

    function infoSwal(title, message, html=null, timer=null, showConfirmButton=false) {
        var timerVal = 2000;
        if(timer!=null)
        {
            timerVal = timer;
        }
        var showConfirmButtonVal = false;
        if(showConfirmButton!=null)
        {
            showConfirmButtonVal = showConfirmButton;
        }
        Swal.fire({
            title : title,
            text  : message,
            html  : html,
            type  : "info",
            timer : timerVal,
            showConfirmButton: showConfirmButtonVal
        });
    }

</script>
