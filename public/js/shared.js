function itemPage (data, i) {
    if(i == data.current_page){
        item = '<li class="page-item active">';
    }else{
        item = '<li class="page-item">';
    }
    item += '<a class="page-link" id="' + i + '" href="javascript:void(0)">' + i + '</a></li>';
    return item
}

function montaPaginacao (data) {
    $('#paginacao>ul>li').html('');
    i = data.current_page - 1;
    if(data.current_page == 1){
        item = '<li class="page-item disabled">';
    }else{
        item = '<li class="page-item">';
    }
    item += '<a class="page-link" id="' + i + '" href="javascript:void(0)">Anterior</a></li>';
    $('#paginacao>ul').append(item);

    n = 10;
    if (data.current_page - n/2 <= 1) {
        inicio = 1
    } else if (data.last_page - data.current_page < n) {
        inicio = data.last_page - n + 1;
    } else {
        inicio = data.current_page - n/2;
    }
    fim = inicio + n - 1
    paginas = data.total / data.per_page
    fim = (fim > paginas) ? paginas + 1 : fim;

    for (i=inicio; i<fim; i++) {
        item = itemPage(data,i)
        $('#paginacao>ul').append(item);
    }
    i = data.current_page + 1;
    if(data.last_page == data.current_page){
        item = '<li class="page-item disabled">';
    }else{
        item = '<li class="page-item">';
    }
    item += '<a class="page-link" id="' + i + '" href="javascript:void(0)">Proximo</a></li>';   
    $('#paginacao>ul').append(item);

}