<?php include 'conexao.php'; ?>

<table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marca</th>
					<th>Produto</th>
					<th>Preço</th>
					<th>Qtd Estoque</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
				<?php
				$sql_consult2 = $sqli->query("SELECT * FROM produtos ORDER BY nome ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];
				
				$sql_mar = $sqli->query("SELECT * FROM marcas WHERE id='".$dados['id_marca']."'");
				$row_mar = $sql_mar->fetch_assoc();
				?>
                <tr>
                    <td><?php echo $dados['id'] ?></td>
                    <td><?php echo $row_mar['marca'] ?></td>
                    <td><?php echo $dados['nome'] ?></td>
                    <td>R$ <?php echo number_format($dados['preco'], 2, ',','.'); ?></td>
                    <td><?php echo $dados['qtd'] ?></td>
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
				$sql_consult2 = $sqli->query("SELECT * FROM produtos ORDER BY nome ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];
				
				$sql_mar = $sqli->query("SELECT * FROM marcas WHERE id='".$dados['id_marca']."'");
				$row_mar = $sql_mar->fetch_assoc();
				?>								

  	<div class="modal modal-primary" id="pop_excluir_<?php echo $id ?>">
 		<form method="post" class="form-delete-produto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Excluir Produto</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <div class="col-md-12">
             	<p>Tem certeza que deseja excluir o Produto <?php echo $dados['nome'] ?>?</p>
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
 		<form method="post" enctype="multipart/form-data" target="_self" class="form-atualizar-produto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar Produto</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />

			<div class="col-md-6">
              <div class="form-group">
                <label>Marca</label>
                <select name="id_marca" id="id_marca" class="form-control">
					<option value="<?php echo $dados['id_marca'] ?>" selected><?php echo $row_mar['marca'] ?></option>
					<?php
					$sql_marcas = $sqli->query("SELECT * FROM marcas ORDER BY marca ASC");
					while($row_marcas = $sql_marcas->fetch_assoc()) {
					?>
					<option value="<?php echo $row_marcas['id'] ?>"><?php echo $row_marcas['marca'] ?></option>
					<?php
					}
					?>
				</select>
              </div>
            </div>
								

             <div class="col-md-6">
              <div class="form-group">
                <label>Produto</label>
                <input type="text" name="nome" class="form-control" placeholder="Produto" id="nome" required="required" value="<?php echo $dados['nome'] ?>" />         
              </div>
            </div>
			
             <div class="col-md-6">
              <div class="form-group">
                <label>Preço</label>
                <input type="text" name="preco" class="form-control" placeholder="Preço (Preencher valores sem vírgula e pontos)" id="preco" required="required" onKeyPress="FormataValor(this.id, 10, event)" value="<?php echo $dados['preco'] ?>" />         
              </div>
            </div>

             <div class="col-md-6">
              <div class="form-group">
                <label>Qtd em Estoque</label>
                <input type="number" name="qtd" class="form-control" placeholder="Qtd em Estoque" id="qtd" required="required" value="<?php echo $dados['qtd'] ?>" />         
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