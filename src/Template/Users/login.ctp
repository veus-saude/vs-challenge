<form role="form" action="" method="POST" id="form-valida">
    <div class="users form">
        <h5><b><?= __('Please enter your e-mail and password') ?></b></h5>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>

        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>

        <?= $this->Form->button(__('Login')); ?>
        <?= $this->Form->end() ?>
        <hr>

        <li><?= $this->Html->link('Ainda não estou cadastrado!', ['controller' => 'Users', 'action' => 'add']) ?></li>
	 
    </div>
