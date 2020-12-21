<script src="{{ asset("Auth-Panel/assets/node_modules/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<!-- start - This is for export functionality only -->
<script src="{{ asset("Auth-Panel/dataTableButtons/dataTables.buttons.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/assets/node_modules/datatables.net/js/dataTables.responsive.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/buttons.flash.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/jszip.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/pdfmake.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/vfs_fonts.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/buttons.html5.min.js") }}"></script>
<script src="{{ asset("Auth-Panel/dataTableButtons/buttons.print.min.js") }}"></script>

<script>
    $(function () {
        $('#file_export').DataTable({
            dom: 'Bfrtip',
            buttons:
                [
                    {
                        extend:    'excel',
                        className: 'btn btn-primary',
                        text:      '<i class="fa fa-file-excel"></i> | Exp. Excel',
                        titleAttr: 'Exportar para Arquivo  de Excel'
                    },
                    {
                        extend:    'pdf',
                        className: 'btn btn-primary',
                        text:      '<i class="fa fa-file-pdf"></i> | Exp. PDF',
                        titleAttr: 'Exportar para Arquivo  de PDF'
                    },
                    {
                        extend:    'csv',
                        className: 'btn btn-primary',
                        text:      '<i class="fa fa-file-excel"></i> | Exp. CSV',
                        titleAttr: 'Exportar para Arquivo  de CSV'
                    },
                    {
                        extend:    'print',
                        className: 'btn btn-primary',
                        text:      '<i class="fa fa-print"></i> | Imprimir',
                        titleAttr: 'Imprimir esta tabela'
                    },
                    @can("$routeAmbient.$routeCrud.create")
                    {
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-plus"> | Criar Novo</i>',
                        action: function ( e, dt, node, config ) {
                            clickCreate();
                            window.location='{{ route("$routeAmbient.$routeCrud.create") }}';
                        },
                        titleAttr: "Cadastrar {{ $crud ?? "" }}"
                    },
                    @endcan
                ],
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
<!----------------------------------- DataTable and ServerSide -------------------------------------------------------->
