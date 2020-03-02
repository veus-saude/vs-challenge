
function submit(){
    let URL_TO_FETCH = 'http://127.0.0.1:8000/api/v1/produtos?'
    for(let i = 0; i < document.querySelectorAll('#form input').length; i++){
        let dados = document.querySelectorAll('#form input');   
        let validar = dados[i].value ? [dados[i].name] + '=' + dados[i].value : false
        if(validar){     
        URL_TO_FETCH += validar  + '&'
        }
    }

    fetch(URL_TO_FETCH, { 
        method: 'get', // opcional
        headers: {
                'Content-Type': 'application/json',
                'Authorization' : '1234'
              }
      })
      .then(res => { 
         return res.json().then(body => {
            $(document).ready(function() {
                $('#table').DataTable( {
                    data: body,
                    columns: [
                        { title: "Nome" },
                        { title: "Marca" },
                        { title: "Preço" },
                        { title: "Quantidade." }
                    ],
                    destroy: true,
                    searching: false,
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
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                } );
            } );
            });
      })
      .catch(function(err) { console.log(err); });
    
}