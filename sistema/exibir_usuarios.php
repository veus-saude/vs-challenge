<?php include 'conexao.php'; ?>

<table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>&nbsp;</th>
					<th>Nome</th>
                    <th>Usuário</th>
					<th>Token</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
				<?php
				$sql_consult2 = $sqli->query("SELECT * FROM usuarios ORDER BY nome ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];

				if ($dados['foto'] == "") { $avatar = "fotos/avatar.png"; }
				if ($dados['foto'] != "") { $avatar = $dados['foto']; }				
				?>
                <tr>
                    <td><img src="avatar_user2.php?foto=<?php echo $avatar ?>" class="img-circle img-thumbnail" style="padding:2px;" /></td>
                    <td><?php echo $dados['nome'] ?></td>
                    <td><?php echo $dados['usuario'] ?></td>
					<td><?php echo $dados['token'] ?></td>
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
				$sql_consult2 = $sqli->query("SELECT * FROM usuarios ORDER BY nome ASC");
				while ($dados = $sql_consult2->fetch_assoc()) {
				$id = $dados['id'];

				if ($dados['foto'] == "") { $avatar = "fotos/avatar.png"; }
				if ($dados['foto'] != "") { $avatar = $dados['foto']; }				
				?>					

  	<div class="modal modal-primary" id="pop_excluir_<?php echo $id ?>">
 		<form method="post" class="form-delete-usuario">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Excluir Usuário</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <div class="col-md-12">
             	<p>Tem certeza que deseja excluir o Usuário <?php echo $dados['nome'] ?>?</p>
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
 		<form method="post" enctype="multipart/form-data" target="_self" class="form-atualizar-usuario">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Editar Usuário</h4>
              </div>
              <div class="modal-body">

			  <div class="row">

			 <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />

			 <div class="col-md-12">
              <div class="form-group">
                <label>Token para API</label>
                <p><?php echo $dados['token'] ?></p>         
              </div>
            </div>

			 <div class="col-md-12">
              <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="Nome" id="nome" required="required" value="<?php echo $dados['nome'] ?>" />         
              </div>
            </div>
			
             <div class="col-md-6">
              <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="usuario" class="form-control" placeholder="Usuário" id="usuario" required="required" value="<?php echo $dados['usuario'] ?>" />         
              </div>
            </div>

             <div class="col-md-6">
              <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Senha" id="senha" required="required" value="<?php echo $dados['senha'] ?>" />         
              </div>
            </div>			
			
             <div class="col-md-12">
              <div class="form-group">
                <label>Atualizar Foto</label>
                <input type="file" name="arquivo" />
				<input type="hidden" name="arquivo_antigo" value="<?php echo $dados['foto'] ?>" />
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