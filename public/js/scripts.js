$(document).ready(function () {
    $('#dataTable').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Pesquisar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }
    });
});

$('#check-uncheck').on('click', function () {
    let checked = this.checked;
    $('.check').each(function () {
        $(this).prop('checked', checked);
    });
});

$('#check-uncheck, .check').on('click', function () {
    var count = 0;
    $('.check:checked').each(function() {
        count++;
    });

    if (count > 0) {
        $('.delete-selected').show();
    } else {
        $('.delete-selected').hide();
    }
});

// Exclusão de registros selecionados através do checkbox
$('.delete-selected').on('click', function(e) {

    e.preventDefault();
    var url = $(this).data('url');
    var token = $(this).data('token');
    var items = [];

    $('.check:checked').each(function() {
        items.push(this.value);
    });

    $.ajax({
        url: url,
        type: "post",
        data: {
            ids: items,
            _token: token
        },
        success: function(response) {
           window.location.reload();
        }
    });
});

// MASKS
$(".maskMoney").mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});
