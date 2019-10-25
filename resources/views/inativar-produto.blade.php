@extends('produto')

@section('content')
                 
          <h5 class="text-center mb-4"><strong>Inativar Produto: </strong> <?php echo $produto->nome; ?></h5>
                    
          Você está prestes a efetuar a INATIVAÇÃO deste produto.  

          <br /><br />
          
          <form method="POST" action="{{route('inativar-produto')}}" enctype="multipart/form-data"> 
            @csrf
            
            <div class="col--4 col-xs-12">
              <div class="form-group">
                <label class="control-label">Motivo da inativação <span class="required-red">*</span></label>
              </div>
                
              <div class="row">
                    <div class="col-sm-6">  
                        <div class="form-group">
                            <textarea class="form-control" rows="4" id="motivo" name="motivo" minlength="10" required></textarea>
                        </div>
                    </div>
              </div>
              
               Deseja realmente INATIVAR este PRODUTO?

               <br /><br />

               <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
               
               <button type="button" class="btn btn-danger btn-sm" onclick="window.location.replace('<?php echo URL::previous(); ?>');">Cancelar</button>

               <br />

               <input type="hidden" id="cod_produto" name="cod_produto" value="<?php echo $codigo_produto; ?>" />

            </div>
          </form>
        
    
@endsection