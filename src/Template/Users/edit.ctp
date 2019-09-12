<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('id_pessoa', array('options' => $people));
	    echo $this->Form->input('email', array ('label' => __('email')));
            echo $this->Form->input('password');
            echo $this->Form->select('tx_status', $status, ['default' => 'A'], array ('label' => __('tx_status')));
            echo $this->Form->input('id_user_inclusao');
            echo $this->Form->input('id_user_modified');
        ?>
    </fieldset>
    
    
    <fieldset>
	<legend><?= __('UsersProfiles') ?></legend>

            <div onclick="adicionarPerfil();" class="adResponsavel" title="Adicionar Perfil">
                Adicionar Perfil
            </div>
            <br><br>

  <table class="table">
            <tr>
                <th><?= __('UsersProfiles') ?></th>
                <th><a href="javascript:adicionarPerfil();">Adicionar Perfil</a></th>
            </tr>
            <?php foreach ($user['perfis'] as $profile): ?>
              <?php if ( isset($profile->nome) ) : ?>
                <tr>
                  <td><?= h($profile->nome) ?></td>
                  <td><?= $this->Html->link(__('Editar'), ['controller'=>'UsersProfiles','action' => 'edit', $profile->id], ['class'=>'btn btn-primary btn-xs']) ?></td>
                </tr>
              <?php endif;  ?>
            <?php endforeach; ?>
  </table>

  <section id="perfil">

  </section>
  
        </fieldset>
        <fieldset class="fieldset-button">
    <button type="button" class="btn btn-back" onclick="javascript:window.history.back()"><?= __('BACK') ?></button>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </fieldset>
</div>

<script> 



    var count = 0;
    function adicionarPerfil(){

        html = '<fieldset id="field-Perfil-'+count+'" class="field-Perfil">';
        html += '<div class="form-group text text-perfil">Perfil '+(count+1)+'</div>';
        html += '<div class="form-group text">';
        html += '<label for="profile-nome">Nome:</label>';
        html += '<input type="text" name="profiles['+count+'][nome]" id="profile-'+count+'-nome" class="form-control">';
        html += '</div>';
        html += '</div>';
        html += '</fieldset>';
        $("#perfil").append(html);

    
        count++;
    }
    
</script>