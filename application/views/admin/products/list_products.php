<?= $header ?>
<section>
    <div class="mainwrapper">
        <?= $menu ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-medkit"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('users/dashboard') ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Produtos médicos</li>
                        </ul>
                        <h4>Lista de produtos</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="panel panel-primary-head">
                    <table id="table_list_product" class="table table-striped table-bordered responsive">
                        <thead class="">
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Criado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($listProductsArray)):
                                foreach ($listProductsArray as $products):
                                    ?>
                                    <tr>
                                        <td><?= $products->product_name ?></td>
                                        <td>R$ <?= $CI->convert_lib->doubleToCurrency($products->price)  ?></td> 
                                        <td><?= ($products->status == 1) ? "<span class='label label-success'>Produto ativo</span>" : "<span class='label label-default'>Produto inativo</span>" ?></td>
                                        <td><?= $CI->convert_lib->dateMysqlTimeToBrazilianDateTime($products->created_at) ?></td>
                                        <td><a href="<?= base_url('products/edit_product/' . $products->id_products) ?>" class="btn btn-primary btn-rounded">Editar</a></td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>      
            </div><!-- contentpanel -->

        </div>
    </div><!-- mainwrapper -->
</section>
<?=
$footer?>