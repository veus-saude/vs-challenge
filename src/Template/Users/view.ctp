<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Tx Senha') ?></th>
            <td><?= h($user->tx_senha) ?></td>
        </tr>
        <tr>
            <th><?= __('Tx Status') ?></th>
            <td><?= h($user->tx_status) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Pessoa') ?></th>
            <td><?= $this->Number->format($user->id_pessoa) ?></td>
        </tr>
        <tr>
            <th><?= __('Id User Inclusao') ?></th>
            <td><?= $this->Number->format($user->id_user_inclusao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id User Modified') ?></th>
            <td><?= $this->Number->format($user->id_user_modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
