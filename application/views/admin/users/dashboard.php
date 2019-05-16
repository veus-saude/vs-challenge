<?= $header ?>
<section>
    <div class="mainwrapper">
        <?= $menu ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Meu Painel</li>
                        </ul>
                        <h4>Meu Painel</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->
            <div class="contentpanel">
                <div class="row row-stat">
                    <div class="col-md-4">
                        <div class="panel panel-dark noborder">
                            <div class="panel-heading noborder">
                                <div class="panel-btns">
                                    <a href="#" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title="Close Panel"><i class="fa fa-times"></i></a>
                                </div><!-- panel-btns -->
                                <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                <div class="media-body">
                                    <h5 class="md-title nomargin">Novos produtos médicos</h5>
                                    <h1 class="mt5"><?=$totalProducts?></h1>
                                </div><!-- media-body -->
                                <hr>
                                <div class="clearfix mt20">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin">Ontem</h5>
                                        <h4 class="nomargin"><?=$countYesterday?></h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin">Esta Semana</h5>
                                        <h4 class="nomargin"><?=$countLastWeek?></h4>
                                    </div>
                                </div>

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="panel-btns">
                                    <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                </div><!-- panel-btns -->
                                <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                <div class="media-body">
                                    <h5 class="md-title nomargin">Valor total do produtos do Mês</h5>
                                    <h1 class="mt5">R$<?=$CI->convert_lib->doubleToCurrency($totalPrice)?></h1>
                                </div><!-- media-body -->
                                <hr>
                                <div class="clearfix mt20">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin">Mês anterior</h5>
                                        <h4 class="nomargin">R$0,00</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin">Esta Semana</h5>
                                        <h4 class="nomargin">R$<?=$CI->convert_lib->doubleToCurrency($totalLastWeek)?></h4>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-4 -->
                    <div class="col-md-4">
                        <div class="panel panel-primary noborder">
                            <div class="panel-heading noborder">
                                <div class="panel-btns">
                                    <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                </div><!-- panel-btns -->
                                <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                <div class="media-body">
                                    <h5 class="md-title nomargin">Total de Gastos Mensal</h5>
                                    <h1 class="mt5">R$<?=$CI->convert_lib->doubleToCurrency($totalPrice)?></h1>
                                </div><!-- media-body -->
                                <hr>
                                <div class="clearfix mt20">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin">Mês anterior</h5>
                                        <h4 class="nomargin">R$0,00</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin">Esta Semana</h5>
                                        <h4 class="nomargin">R$<?=$CI->convert_lib->doubleToCurrency($totalLastWeek)?></h4>
                                    </div>
                                </div>

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-4 -->
                </div><!-- row -->
            </div><!-- contentpanel -->
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?= $footer?>