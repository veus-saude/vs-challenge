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
                        <h4>Novo produto</h4>
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
                                <?= form_open(base_url('admin/products/post_information_product'), array('name' => 'create_product', 'id' => 'create_product')); ?>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="product_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Preço</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control mask_money" name="price" />
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-sm-offset-11">
                                            <button class="btn btn-success mr5" type="button" id="create_product_button">Criar</button>
                                        </div>
                                    </div>
                                </div>
                                <?= form_close() ?>
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