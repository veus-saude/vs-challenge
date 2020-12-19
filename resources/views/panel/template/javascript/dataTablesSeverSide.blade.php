<script>
    $(function () {
        $('#file_export').DataTable({
            dom: 'Bfrtip',
            buttons: buttons,
            stateSave: true,
            responsive:true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "pagingType": "full_numbers",
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            // Configuração Server Side --------------------------------------------------------------------------------
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"                      : "{{ route("panel.dataTableServerSide.init") }}",
                "dataType"                 : "json",
                "type"                     : "POST",
                "data"                     : {
                    "_token"               : "{{ csrf_token() }}",
                    "table"                : table_name,
                    "columns"              : columns,
                    "statusCondition"      : statusCondition,
                    "statusVerify"         : statusVerify,
                },
            },
            "columns":columns
            // ---------------------------------------------------------------------------------------------------------
        });
    });

    function clickCreate()
    {
        let timerInterval;
        Swal.fire({
            title: 'Aguarde o processamento!',
            html: 'O sistema está tentando realizar a ação.',
            timer: false,
            onBeforeOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('strong')
                    //.textContent = Swal.getTimerLeft()
                }, 100)
            },
            onClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.timer
            ) {
                console.log('I was closed by the timer')
            }
        });
    }

</script>
