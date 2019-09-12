<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('brand');
            echo $this->Form->control('description');
            echo $this->Form->control('price');
            echo $this->Form->control('qtd');
        ?>
    </fieldset>
  
    <fieldset class="fieldset-button">
        <div class="left"><button type="button" class="btn-back" onclick="javascript:window.history.back()"><?= __('BACK') ?></button></div>
        <div class="obs center" style="float: left;">
            
        </div>
        <div class="right"><?= $this->Form->button(__('Submit')) ?></div>
        <?= $this->Form->end() ?>
    </fieldset>
</div>
