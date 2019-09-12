<div class="products index large-12 medium-8 columns content">
<div id="esquerda">
    <h3><?= __('Products') ?></h3>
                    </div>
    <div id="direita"><?= $this->Html->link($this->Html->image('ico_1.png', array('alt' => "Cadastrar Nova")) . ' ' . __('Add Product'), ['action' => 'add'], array('escape' => false)); ?></div>
    <div class="row form-group-pesq">
        <?= $this->Form->create('index', ['type' => 'get', 'class' => 'search-form']) ?>
        <div class='col-md-3'>
            <input type="text" name="name" placeholder="Nome" id="field-search" value="<?= $name ?>" class="form-control inline-field search-field-sponsor">
        </div>
        <div class='col-md-3' style="margin-top: -21px;">
            <input type="text" name="brand" placeholder="Marca" id="field-search" value="<?= $brand ?>" class="form-control cpf inline-field search-field-sponsor">
        </div>
        <div class='col-md-2'>
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
                <th width='4%'><?= $this->Paginator->sort(__('id')) ?></th>
                <th width='35%'><?= $this->Paginator->sort('name', array('label' => __('name'))) ?></th>
                <th width='15%'><?= $this->Paginator->sort(__('brand')) ?></th>
                <th width='10%'><?= $this->Paginator->sort(__('price')) ?></th>
                <th width='10%'><?= $this->Paginator->sort(__('qtd')) ?></th>
                <th width='15%' class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->name) ?></td>
                <td><?= h($product->brand) ?></td>
                <td>R$ <?= $this->Number->format($product->price) ?></td>
                <td><?= $this->Number->format($product->qtd) ?> un.</td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
