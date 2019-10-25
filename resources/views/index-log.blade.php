@extends('produto')

@section('content')

<p><h5 class="text-center mb-4">Listar de Logs</h5></p>    

<p><a class="btn btn-outline-primary btn-sm" href="{{ url('painel') }}"><i class="fa fa-plus"></i> Painel</a></p>

<div class="row">
    <div class="col-md-12">
        <table class="table table-responsive">
            <tr>
                <th>Motivo</th>
                <th>Mensagem</th> 
                <th><input class="form-control" id="myInput" type="text" placeholder="Filtrar.."></th>
            </tr>
            @foreach($logs as $log)
            <tbody id="myTable">
                <tr>
                    <td>{{$log->motivo}}</td>
                    <td>{{$log->mensagem}}</td>  
                    <td>-</td>
                </tr>
            </tbody>
            @endforeach
        </table>
        
        <!--Paginação PAGINATE-->
        {{$logs->links()}}
        
    </div>
    
</div>
<script>
<!--Função para buscar resultado na tabela-->
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>    
@endsection