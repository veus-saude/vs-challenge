<?php include 'conexao.php'; ?>

<table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marca</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
				<?php
				$sql_consult2 = $sqli->query("SELECT * FROM marcas ORDER BY marca ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];
				?>
                <tr>
                    <td><?php echo $dados['id'] ?></td>
                    <td><?php echo $dados['marca'] ?></td>
                    <td><a data-toggle="modal" data-target="#pop_edita_<?php echo $id ?>"><button class="btn btn-sm btn-warning"><span class="fa fa-search"></span></button></a>
                    </td>
                    <td><a data-toggle="modal" data-target="#pop_excluir_<?php echo $id ?>"><button class="btn btn-sm btn-warning"><span class="fa fa-trash-o"></span></button></a>
                    </td>
                </tr>
                  <?php
					}
					?>                
                
                </tbody>
                                        </table>
										
										
				<?php
				$sql_consult2 = $sqli->query("SELECT * FROM marcas ORDER BY marca ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];
				?>										

  	<div class="modal modal-primary" id="pop_excluir_<?php echo $id ?>">
 		<form method="post" class="form-delete-marca">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Excluir Marca</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <div class="col-md-12">
             	<p>Tem certeza que deseja excluir a Marca <?php echo $dados['marca'] ?>?</p>
             </div>

			 <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />

           </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-warning pull-right" value="Sim" />
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Não</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
                 </form>
        </div>
                
                
        
  	<div class="modal modal-primary" id="pop_edita_<?php echo $id ?>">
 		<form method="post" enctype="multipart/form-data" target="_self" class="form-atualizar-marca">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar Marca</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />


             <div class="col-md-12">
              <div class="form-group">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control" placeholder="Marca" id="marca" required="required"value="<?php echo $dados['marca'] ?>" />         
              </div>
            </div>
           


           </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-warning pull-right" value="Atualizar" />
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
                 </form>
        </div>

             
                  <?php
					}
					?>										