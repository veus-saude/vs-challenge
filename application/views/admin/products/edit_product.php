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
                        <h4>Alteração de produto</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Dados do produto médico</h4>
                            </div><!-- panel-heading -->
                            <div class="panel-body nopadding">
                                <?php
                                echo form_open(base_url('admin/products/put_information_product'), array('name' => 'edit_product', 'id' => 'edit_product'));
                                if (!empty($productArray)):
                                    foreach ($productArray as $product):
                                        ?>
                                        <br>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="product_name" value="<?= $product->product_name ?>"/>
                                                <input type="hidden" name="product_id" value="<?= $product->id_products ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Preço</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control mask_money" name="price" value="<?= $CI->convert_lib->doubleToCurrency($product->price) ?>" />
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-12 col-sm-offset-10">
                                                    <button class="btn btn-danger mr5" type="button" id="delete_product_button">Deletar</button>
                                                    <button class="btn btn-success mr5" type="button" id="edit_product_button">Editar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                                echo form_close()
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- mainwrapper -->
</section>
<?=
$footer?>