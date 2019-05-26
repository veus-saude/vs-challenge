/* Validação de campos requeridos */
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('validar');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    setupok();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function setupok() {

    var host = $('#host').val();
    var schema = $('#schema').val();
    var usuario = $('#usuario').val();
    var senha = $('#senha').val();

    $.ajax({
        url: 'config.php',
        method: 'POST',
        data: {host: host, schema: schema, usuario: usuario, senha: senha},
        success: function () {
            location.reload();
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        }
    });
};