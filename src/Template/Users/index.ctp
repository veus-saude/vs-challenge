<div class="users index large-12 medium-8 columns content">
    <div id="esquerda"><h3><?= __('Users') ?></h3></div>
    <div id="direita"><?= $this->Html->link($this->Html->image('ico_1.png', array('alt' => "Cadastrar Novo")) . ' ' . __('Add User'), ['action' => 'add'], array('escape' => false)); ?></div>
                    <div class="row form-group-pesq">
                        <?= $this->Form->create('index', ['type'=>'get','class'=>'search-form']) ?>
                        <div class='col-md-3'>
                            <input type="text" name="username" placeholder="Username" id="field-search" class="form-control inline-field search-field-sponsor">
                        </div>
                        <div class='col-md-3'>
                            <input type="text" name="password" placeholder="Senha" id="field-search" class="form-control cpf inline-field search-field-sponsor">
                        </div>
                <div class='col-md-2'>
                    
                    <select name="role" placeholder="Perfil" id="field-search" class="form-control inline-field search-field-sponsor">
                        <option value="admin">Visita</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                        <div class='col-md-1' style='float: left;'>
                            <?= $this->Form->button(__('Filtrar',true), array('class'=>'bt-search')) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('password') ?></th>
                <th><?= $this->Paginator->sort('role') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= $user->username ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= $user->role ?></td>
                <td><?= $this->Time->format($user->created, 'd/M/Y') ?></td>
                <td><?= $this->Time->format($user->modified, 'd/M/Y') ?></td>
                <td class="actions">
		    <?= $this->Html->image("ico_Atualizar.gif", array('alt' => "Edit",'url' => array('action' => 'edit', $user->id))); ?>
		    <?= $this->Form->postLink($this->Html->image('delete.png', array('alt' => __('Delete'))), array('action' => 'delete', $user->id), array('escape' => false, 'confirm' => __('Are you sure you want to delete the post '.$user->name.' ?', $user->id))); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
