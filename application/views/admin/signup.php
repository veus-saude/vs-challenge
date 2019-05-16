<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Vaus</title>
        <link href="<?= base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    </head>

    <body class="signin">
        <section>
            
            <div class="panel panel-signup">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?= base_url('assets/images/veus.png') ?>" alt="logo">
                    </div>
                    <br />
                    <h4 class="text-center mb5 login_text">Crie uma nova conta</h4>
                    
                    <div class="mb30"></div>
                    <?= form_open(base_url('users/createClient'), array('name' => 'formSignup')); ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Nome" name="name">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="E-mail" name="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Senha" name="password">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="clearfix">
                            <div>
                                <button type="submit" class="btn btn-success btn-block">Crie a nova conta <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>
                    <?= form_close() ?>
                    
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <a href="<?= base_url('admin/users/index') ?>" class="btn btn-primary btn-block">Se possuir uma conta. Clique aqui.</a>
                </div><!-- panel-footer -->
            </div><!-- panel -->
        </section>
      <script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/modernizr.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/retina.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery.cookies.js') ?>"></script>
        <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    </body>
</html>
