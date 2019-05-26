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
                    var id = $('#idproduto').val();
                    if (id) {
                        updateok();
                    } else {
                        insertok();
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
$(document).ready(function () {
    $(".quantidade").mask('0#');
    $('.money').maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: true});
    $.ajax({
        url: 'api/v1/products/',
        headers: {'Authorization': basic()},
        success: function (data) {
            var obj = convertJsonToObject(data);
            var txt = '';
            for (i in obj.produtos) {
                var item = obj.produtos[i];
                txt += '<tr><th scope="row">' + item.id_product + '</th>'
                        + '<td>' + item.name + '</td>'
                        + '<td>' + item.brand + '</td>'
                        + '<td>R$ ' + item.value + '</td>'
                        + '<td>' + item.quantity + '</td>'
                        + '<td class="text-center">'
                        + '<a href="#" class="update" id="update-' + item.id_product + '" valor="' + item.id_product + '" title="Editar produto"><i class="fas fa-pencil-alt"></i></a> '
                        + '<a href="#" class="delete" id="delete-' + item.id_product + '" valor="' + item.id_product + '" title="Excluir produto"><i class="fas fa-trash-alt"></i></a>'
                        + '</td></tr>';
                $('#table-content').html(txt);
            }
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        }
    });
});
$(document).on('click', '#new', function () {
    $('#btn-salvar').addClass('insert');
    $('#btn-salvar').removeClass('updateok');
    $('#btn-salvar').html('Salvar');
    $('#idproduto').val('');
    $('#name').val('');
    $('#brand').val('');
    $('#value').val('');
    $('#quantity').val('');
    $('#produtoform').show();
});
function insertok() {
    $('#btn-salvar').removeClass('updateok');
    $('#btn-salvar').addClass('insert');
    var name = $('#name').val();
    var brand = $('#brand').val();
    var value = $('#value').val();
    var quantity = $('#quantity').val();
    $('#modalBtnFechar').addClass('reload');
    $('#modalBtnNao').hide();
    $('#modalBtnFechar').show();
    $('#modalBtnSim').hide();
    $.ajax({
        url: 'api/v1/products/',
        headers: {'Authorization': basic()},
        method: 'PUT',
        data: {name: name, brand: brand, value: value, quantity: quantity},
        success: function (data, status, request) {
            if (request.status == 200) {
                $('#modalMsg').html('Produto inserido com sucesso.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            } else {
                alert(erro);
                console.log(data);
                $('#modalMsg').html('Erro ao inserir produto.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        },
        error: function (request) {
            if (request.status == 412) {
                var erros = request.responseJSON;
                $.each(erros, function (campo, mensagem) {
                    $('#' + campo + '-msg').html(mensagem);
                    $('#formContato').addClass('was-validated');
                })
            }
        }
    });
};
$(document).on('click', '.update', function () {
    $('#btn-salvar').removeClass('insert');
    $('#btn-salvar').addClass('updateok');
    var id = $(this).attr('valor');
    $.ajax({
        url: 'api/v1/products?id=' + id,
        headers: {'Authorization': basic()},
        success: function (data) {
            var obj = convertJsonToObject(data);
            var item = obj.produtos[0];
            $('#btn-salvar').html('Editar');
            $('#idproduto').val(item.id_product);
            $('#name').val(item.name);
            $('#brand').val(item.brand);
            $('#value').val('R$ ' + item.value);
            $('#quantity').val(item.quantity);
            $('#produtoform').show();
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        }
    });
});
function updateok() {
    var id = $('#idproduto').val();
    var name = $('#name').val();
    var brand = $('#brand').val();
    var value = $('#value').val();
    var quantity = $('#quantity').val();
    $('#modalBtnFechar').addClass('reload');
    $('#modalBtnNao').hide();
    $('#modalBtnFechar').show();
    $('#modalBtnSim').hide();
    $.ajax({
        url: 'api/v1/products/',
        headers: {'Authorization': basic()},
        method: 'POST',
        data: {id: id, name: name, brand: brand, value: value, quantity: quantity},
        success: function (data, status, request) {
            if (request.status == 200) {
                $('#btn-salvar').removeClass('updateok');
                $('#modalMsg').html('Produto atualizado com sucesso.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            } else {
                $('#modalMsg').html('Erro ao atualizar produto.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        },
        error: function (request) {
            if (request.status == 412) {
                var erros = request.responseJSON;
                $.each(erros, function (campo, mensagem) {
                    $('#' + campo + '-msg').html(mensagem);
                    $('#formContato').addClass('was-validated');
                })
            }
        }
    });
};
$(document).on('click', '.delete', function () {
    var id = $(this).attr('valor');
    $('#modalBtnSim').attr('valor', id);
    $('#modalBtnSim').addClass('deleteok');
    $('#modalMsg').html('Tem certeza que deseja excluir?');
    $('#modalBtnNao').show();
    $('#modalBtnFechar').hide();
    $('#modalBtnSim').show();
    $('#alertMsg').modal({
        show: true,
        keyboard: false,
        backdrop: 'static'
    });
});
$(document).on('click', '.deleteok', function () {
    $('#alertMsg').modal({
        show: false,
    });
    var id = $(this).attr('valor');
    $('#modalBtnSim').removeClass('deleteok');
    $('#modalBtnFechar').addClass('reload');
    $('#modalBtnNao').hide();
    $('#modalBtnFechar').show();
    $('#modalBtnSim').hide();
    $.ajax({
        url: 'api/v1/products/' + id,
        headers: {'Authorization': basic()},
        method: 'DELETE',
        success: function (data, status, request) {
            if (request.status == 200) {
                $('#modalMsg').html('Produto excluido com sucesso.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            } else {
                $('#modalMsg').html('Erro ao excluir produto.');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        },
        error: function () {
            $('#modalMsg').html('Erro ao excluir produto.');
            $('#alertMsg').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });
        }
    });
});
$(document).on('click', '.reload', function () {
    location.reload();
});
function convertJsonToObject(dados) {
    var retorno = JSON.stringify(dados);
    var dados1 = retorno.replace('[', '{"produtos":[');
    var dados2 = dados1.replace(']', ']}');
    var obj = JSON.parse(dados2);
    return obj;
}
$("#formBusca").submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    $('#produtoform').hide();
    var filter = '';
    var filter2 = '';
    var msg = '';
    var valor = '';
    var search = $('#busca').val();
    var search2 = $('#busca').val();
    var filtro = $('#select-filtro option:selected').val();
    var filtro2 = $('#select-filtro option:selected').text();
    if (filtro != '0') {
        valor = $('#valor-filtro').val();
        filter = filtro + ':' + valor;
        filter2 = filtro2 + '=' + valor;
        search2 += ' e ' + filter2;
    }
    $('#titulo2').html('Resultados para busca por ' + search2);
    if (filtro != '0' && search != '' && valor == '') {
        msg = 'Não existe valor para filtro!!!';
    } else if (filtro != '0' && search == '' && valor == '') {
        msg = 'Não existe valor para busca e filtro!!!';
    } else if (filtro == '0' && search == '') {
        msg = 'Não existe valor para busca!!!';
    }
    if (msg != '') {
        $('#modalBtnNao').hide();
        $('#modalBtnFechar').show();
        $('#modalBtnSim').hide();
        $('#modalBtnFechar').removeClass('reload');
        $('#modalMsg').html(msg);
        $('#alertMsg').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
    } else {
        var id = '';
        if (search != '') {
            search = '&q=' + search;
        }
        $('#pos-busca').val(search);
        if (filter != '') {
            filter = '&filter=' + filter;
        }
        $('#pos-filtro').val(filter);
        var page = '';
        var limit = '';
        var order = '';
        findok(id, search, filter, page, limit, order);
    }
});
$(document).on("change","#select-filtro", function() {
    var filtro = $('#select-filtro option:selected').val();
    if (filtro != '0') {
        $('#valor-filtro').val('');
        $('#div-espaco').hide();
        $('#div-valor-filtro').show();
    } else {
        $('#valor-filtro').val('');
        $('#div-espaco').show();
        $('#div-valor-filtro').hide();
    }
});
$(document).on('click', '.ordenacao', function () {
    var ordem = '';
    var field = $(this).attr('ord-field');
    var tipo = $(this).attr('ord-tipo');
    if (tipo == 'a') {
        ordem = 'ASC';
        $(this).attr('ord-tipo', 'd');
    } else {
        ordem = 'DESC';
        $(this).attr('ord-tipo', 'a');
    }
    if (field == 'name' || field == 'brand') {
        ordem = 'LOWER(' + field + ') ' + ordem;
    } else {
        ordem = "CONVERT(REPLACE(" + field + ",',',''), DECIMAL(15,2)) " + ordem;
    }
    var search = '';
    var filter = '';
    var id = '';
    if ($('#pos-busca').val() != '') {
        search = $('#pos-busca').val();
    }
    if ($('#pos-filtro').val() != '') {
        filter = $('#pos-filtro').val();
    }
    var page = '';
    var limit = '';
    var order = '&order=' + ordem;
    findok(id, search, filter, page, limit, order);
});
function findok(id, search, filter, page, limit, order) {
    $.ajax({
        url: 'api/v1/products?' + id + search + filter + page + limit + order,
        headers: {'Authorization': basic()},
        success: function (data) {
            var txt = '';
            if (data.length === 0) {
                $('#modalBtnNao').hide();
                $('#modalBtnFechar').show();
                $('#modalBtnSim').hide();
                $('#modalBtnFechar').removeClass('reload');
                $('#modalMsg').html('Não existe produto com busca "' + search + '" e filtro "' + valor + '".');
                $('#alertMsg').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            } else {
                var obj = convertJsonToObject(data);
                for (i in obj.produtos) {
                    var item = obj.produtos[i];
                    txt += '<tr><th scope="row">' + item.id_product + '</th>'
                            + '<td>' + item.name + '</td>'
                            + '<td>' + item.brand + '</td>'
                            + '<td>R$ ' + item.value + '</td>'
                            + '<td>' + item.quantity + '</td>'
                            + '<td class="text-center">'
                            + '<a href="#" class="update" id="update-' + item.id_product + '" valor="' + item.id_product + '" title="Editar produto"><i class="fas fa-pencil-alt"></i></a> '
                            + '<a href="#" class="delete" id="delete-' + item.id_product + '" valor="' + item.id_product + '" title="Excluir produto"><i class="fas fa-trash-alt"></i></a>'
                            + '</td></tr>';
                    $('#table-content').html(txt);
                }
            }
        },
        beforeSend: function () {
            $('#mascara').css({display: "block"});
        },
        complete: function () {
            $('#mascara').css({display: "none"});
        }
    });
};
function basic() {
    var user = 'teste';
    var pass = '8f6gdf67df6g8df76g8d';
    var hash = btoa(user + ':' + pass);
    return "Basic " + hash;
}