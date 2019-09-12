<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
    </fieldset>
    
    
    <fieldset class="fieldset-button">
        <div class="left"><button type="button" class="btn-back" onclick="javascript:window.history.back()"><?= __('BACK') ?></button></div>
        <div class="obs center" style="float: left;">
        </div>
        <div class="right"><?= $this->Form->button(__('Submit')) ?></div>
        <?= $this->Form->end() ?>
    </fieldset>
</div>
