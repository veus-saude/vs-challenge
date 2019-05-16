<?= $header ?>
<section>
    <div class="mainwrapper">
        <?= $menu ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url('admin/users/dashboard') ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Usuário</li>
                        </ul>
                        <h4>Acesso API</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Key</h4>
                            </div><!-- panel-heading -->
                            <div class="panel-body nopadding">
                                <form class="form-horizontal form-bordered" id="form_compra_de_estoque" method="post">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Key de acesso</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="valor_compra_estoque" class="form-control" name="valor_compra_estoque" value="<?= $userData->key ?>" readonly="readonly"/>
                                        </div>
                                        <label class="col-sm-12 control-label">Utilize essa key para acessar a API em sites externos.</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- mainwrapper -->
</section>
<?= $footer?>