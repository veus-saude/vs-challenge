<div class="leftpanel">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" >
            <img class="img-circle" src="<?= base_url('assets/images/avatar/avatar_masc_aluno.png') ?>" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?=$userData->name?></h4>
        </div>
    </div>
    <ul class="nav nav-pills nav-stacked">
        <li <?= (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? "class='active'" : "" ?>><a href="<?= base_url('users/dashboard') ?>"><i class="fa fa-home"></i> <span>Meu Painel</span></a></li>
        <li class="parent <?= (strpos($_SERVER['REQUEST_URI'], 'key') !== false) ? "active" : "" ?>"><a href="#"><i class="fa fa-user"></i><span>Usuário</span></a>
            <ul class="children">
                <li  <?= (strpos($_SERVER['REQUEST_URI'], 'user_key') !== false) ? "class='active'" : "" ?>><a href="<?= base_url('users/user_key') ?>">Acesso API</a></li>
            </ul>
        </li>
        <li class="parent <?= (strpos($_SERVER['REQUEST_URI'], 'products') !== false) ? "active" : "" ?>"><a href="#"><i class="fa fa-medkit"></i><span>Produtos médicos</span></a>
            <ul class="children">
                <li  <?= (strpos($_SERVER['REQUEST_URI'], 'list_products') !== false) ? "class='active'" : "" ?>><a href="<?= base_url('products/list_products') ?>">Lista de produtos</a></li>
            </ul>
            <ul class="children">
                <li  <?= (strpos($_SERVER['REQUEST_URI'], 'create_product') !== false) ? "class='active'" : "" ?>><a href="<?= base_url('products/create_product') ?>">Cria novo produto</a></li>
            </ul>
        </li>
    </ul>
</div>