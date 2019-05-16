jQuery(document).ready(function () {
    // Tags Input
    jQuery('#tags').tagsInput({width: 'auto'});
    // Textarea Autogrow
    jQuery('#autoResizeTA').autogrow();
    // Spinner
    var spinner = jQuery('#spinner').spinner();
    spinner.spinner('value', 0);
    
    // Form Toggles
    jQuery('.toggle').toggles({on: true});
    // Time Picker
    jQuery('#timepicker').timepicker({defaultTIme: false});
    jQuery('#timepicker2').timepicker({showMeridian: false});
    jQuery('#timepicker3').timepicker({minuteStep: 15});
    // Date Picker
    jQuery('#datepicker').datepicker();
    jQuery('.datepicker').datepicker();
    jQuery('#datepicker-inline').datepicker();
    jQuery('#datepicker-multiple').datepicker({
        numberOfMonths: 3,
        showButtonPanel: true
    });

    // Input Masks
    jQuery("#date").mask("99/99/9999");
    jQuery("#phone").mask("(999) 999-9999");
    jQuery("#ssn").mask("999-99-9999");
    // Select2
    jQuery("#select-basic, #select-multi").select2();
    jQuery('#select-search-hide').select2({
        minimumResultsForSearch: -1
    });
    jQuery("#location").select2();
    jQuery(".select2").select2();

    function format(item) {
        return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined) ? "" : item.element[0].getAttribute('rel')) + ' mr10"></i>' + item.text;
    }

    // This will empty first option in select to enable placeholder
    jQuery('select option:first-child').text('');

    jQuery("#select-templating").select2({
        formatResult: format,
        formatSelection: format,
        escapeMarkup: function (m) {
            return m;
        }
    });

    // Color Picker
    if (jQuery('#colorpicker').length > 0) {
        jQuery('#colorSelector').ColorPicker({
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                jQuery('#colorpicker').val('#' + hex);
            }
        });
    }

    // Color Picker Flat Mode
    jQuery('#colorpickerholder').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            jQuery('#colorpicker3').val('#' + hex);
        }
    });
    // Basic Slider
    jQuery('#slider').slider({
        range: "min",
        max: 100,
        value: 50
    });
    // Date Picker
    jQuery('#datepicker').datepicker();


    jQuery('#table_list_product').DataTable({
        responsive: true
    });

    var shTable = jQuery('#shTable').DataTable({
        "fnDrawCallback": function (oSettings) {
            jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
        },
        responsive: true
    });

    // Show/Hide Columns Dropdown
    jQuery('#shCol').click(function (event) {
        event.stopPropagation();
    });

    jQuery('#shCol input').on('click', function () {

        // Get the column API object
        var column = shTable.column($(this).val());

        // Toggle the visibility
        if ($(this).is(':checked'))
            column.visible(true);
        else
            column.visible(false);
    });

    var exRowTable = jQuery('#exRowTable').DataTable({
        responsive: true,
        "fnDrawCallback": function (oSettings) {
            jQuery('#exRowTable_paginate ul').addClass('pagination-active-success');
        },
        "ajax": "ajax/objects.txt",
        "columns": [
            {
                "class": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            {"data": "name"},
            {"data": "position"},
            {"data": "office"},
            {"data": "salary"}
        ],
        "order": [[1, 'asc']]
    });

    // Add event listener for opening and closing details
    jQuery('#exRowTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = exRowTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });


    // DataTables Length to Select2
    jQuery('div.dataTables_length select').removeClass('form-control input-sm');
    jQuery('div.dataTables_length select').css({width: '60px'});
    jQuery('div.dataTables_length select').select2({
        minimumResultsForSearch: -1
    });

    $(".mask_money").maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});
    
     $("#create_product_button").click(function () {
        swal({
            title: "Alerta!",
            text: "Deseja criar esse novo produto?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#449D44",
            confirmButtonText: "Confirmar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $('#create_product').attr('action', base_url + 'products/post_information_product');
                $('#create_product').submit();
            } else {
                return false;
            }
        });
    });
    
    $("#edit_product_button").click(function () {
        swal({
            title: "Alerta!",
            text: "Deseja editar esse produto?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#449D44",
            confirmButtonText: "Confirmar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $('#edit_product').attr('action', base_url + 'products/put_information_product');
                $('#edit_product').submit();
            } else {
                return false;
            }
        });
    });
    
    $("#delete_product_button").click(function () {
        swal({
            title: "Alerta!",
            text: "Deseja deletar esse produto?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#449D44",
            confirmButtonText: "Confirmar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $('#edit_product').attr('action', base_url + 'products/delete_information_product');
                $('#edit_product').submit();
            } else {
                return false;
            }
        });
    });
    
    function showTooltip(x, y, contents) {
        jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5
        }).appendTo("body").fadeIn(200);
    }
});

function format(d) {
    // `d` is the original data object for the row
    return '<table class="table table-bordered nomargin">' +
            '<tr>' +
            '<td>Full name:</td>' +
            '<td>' + d.name + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Extension number:</td>' +
            '<td>' + d.extn + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Extra info:</td>' +
            '<td>And any further details here (images etc)...</td>' +
            '</tr>' +
            '</table>';
}

