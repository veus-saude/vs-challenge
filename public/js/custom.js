
var baseUrlAPI = baseUrl + 'api/products';

$("#add-new-product").on("click", function(){
    $("form#add-product").show();
});

$.ajaxSetup({
    headers:{
        'Authorization': 'Bearer ' + localStorage.getItem("token")
    }
});

$("#search-form").on('submit', function(e){
    let data = $(this).serializeArray();
    let filter = '&filter=';
    queryString = '?';
    $(data).each(function(i, e){
        if(e.value == ''){
            return;
        }

        if(e.name != 'q' && e.value != ''){
            filter += `${e.name}:${e.value},`;
        }   
        
        if(e.name == 'q'){
            queryString  += `q=${e.value}`;
        }   
    });

    queryString += filter

    window.location = baseUrl + queryString
    return false;
});

var login = (form) => {
    var datastring = $(form).serialize();
    $.ajax({
        type: "POST",
        url: baseUrl + 'api/login',
        data: datastring,
        dataType: "json",
        success: function(data) {
            
            localStorage.setItem("token", data.token);
            window.location.reload();
            
        },
        error: function(data) {
            if(data.status == 401){
                alert('Usuário não encontrado');
                return;        
            }
            alert('Ocorreu algum erro ao realizar o login, tente novamente');
        }
    });
} 


var logout = (form) => {
    localStorage.removeItem("token");
    window.location.reload();
} 

var showFormAddUser = () =>{
    $("#login").hide();
    $("#add-user").show();
}

var addUser = (form) => {
    var datastring = $(form).serialize();
    $.ajax({
        type: "POST",
        url: baseUrl + 'api/register',
        data: datastring,
        dataType: "json",
        success: function(data) {
            alert('Cadastro realizado com sucesso')
            window.location.reload();
            
        },
        error: function(data) {
            
            alert('Ocorreu algum erro ao realizar o cadastro, tente novamente');
        }
    });
} 

var removeProduct = (id) => {
 
    $.ajax({
        type: "POST",
        url: baseUrlAPI + '/' + id,
        data: {"_method":"delete"},
        dataType: "json",
        success: function(data) {
            alert('Produto Deletado com sucesso!');
            window.location.reload(); 
        },
        error: function(data) {
            if(data.status == 401){
                $("#login").show();
                return;        
            }
            alert('Ocorreu algum erro ao remover o produto, atualize a página')
        }
    });
}

var replaceUrlParam = (paramName, paramValue) => {
    if (paramValue == null) {
        paramValue = '';
    }
    url = window.location.search;
    var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
    if (url.search(pattern)>=0) {
        return url.replace(pattern,'$1' + paramValue + '$2');
    }
    url = url.replace(/[?#]$/,'');
    return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
}

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
    return (results !== null) ? results[1] || 0 : false;
}

if($.urlParam('sort')){
    $($.urlParam('sort').split(',')).each(function(i,e){
       let data = e.split(':');
       $(".th-"+data[0]).attr('data-sorttype',data[1]);
    })
}

$('table#products > thead > tr > th[data-sort]').on("click", function(){
    sort = $(this).data('sort');
    sortType = $(this).attr('data-sorttype');
    order = sortType != 'DESC' ? 'DESC' : 'ASC';

    $(this).attr('data-sorttype',order);
    var pattern = new RegExp('\\b('+sort+':).*?(&|#|$|,)');
    if ($.urlParam('sort') && $.urlParam('sort').search(pattern) >= 0) {
        window.location = replaceUrlParam('sort', $.urlParam('sort').replace(pattern,'$1' + order + '$2'));
        return;
    }
    if ($.urlParam('sort')){
        window.location = replaceUrlParam('sort', $.urlParam('sort')  + ','+ sort + ':' + order);
        return; 
    }
    window.location = window.location.search + '&sort=' + sort + ':' + order;
});

var addProduct = (form) => {
    var datastring = $(form).serialize();
    $.ajax({
        type: "POST",
        url: baseUrlAPI,
        data: datastring,
        dataType: "json",
        success: function(data) {
            alert('Produto Cadastrao com sucesso!');
            window.location.reload(); 
        },
        error: function(data) {
            if(data.status == 401){
                $("#login").show();
                return;        
            }
            alert('Ocorreu algum erro ao adicionar o produto, Tente Novamente')
        }
    });
}

var fillInputsSearch = function(){
    if($.urlParam('q')){
        $('input[name="q"]').val(decodeURI($.urlParam('q').replace('+',' ')))
    }
    
    if($.urlParam('filter')){
        $($.urlParam('filter').split(',')).each(function(i,e){
            let data = e.split(':');
            if(data.length < 2){
                return
            }
            $('input[name="'+data[0]+'"]').val(decodeURI(data[1].replace('+',' ')))
         })
    }
}

var getProducts = (page = 0) => {

    page = $.urlParam('page') ? $.urlParam('page') : 0;
    
    fillInputsSearch();

    var url = baseUrlAPI + '?page='+page;    
    var queryString = '/?'

    if($.urlParam('q')){
        url += "&q=" + $.urlParam('q');
        queryString += "&q=" + $.urlParam('q');        
    }

    if($.urlParam('filter')){
        url += "&filter=" + $.urlParam('filter');
        queryString += "&filter=" + $.urlParam('filter');
    }

    if($.urlParam('sort')){
        url += "&sort=" + $.urlParam('sort');
        queryString += "&sort=" + $.urlParam('sort');
    }

    $.get(url,  function(response) {
        $("#login").hide();
        $("#logged").show();
        lines = '';
        $.each(response.data.data, function(index, item){
            lines += `
            <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.brand}</td>
            <td>${item.price}</td>
            <td>${item.quantity}</td>
            <td><a href="javascript:removeProduct(${item.id})">Excluir</a></td>
            </tr>
            `;
        });

        $('table#products > tbody').html(lines);

        //pagination
        let pagination = '<tr><td colspan="6">';
        if(response.data.current_page > 1){
            pagination += `<a class='float-left btn btn-dark' href="${queryString}&page=${response.data.current_page - 1}"> < página anterior</a>`;
        }

        if(response.data.current_page < response.data.last_page){
            pagination += `<a  class='float-right btn btn-dark' href="${queryString}&page=${response.data.current_page + 1}">Próxima página ></a>`;
        }
        
        pagination += '</td></tr>';

        
        $('table#products > tfoot').html(pagination);
        
    })
    .fail(function(data) {
        if(data.status == 401){
            $("#login").show();
            return;        
        }
        alert('Ocorreu algum erro ao carregar os produtos, atualize a página')
    });
}

getProducts();  