<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
         <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/cropped-favicon-270x270.png')?>">
        <title>Vaus</title>
        <link href="<?= base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    </head>
    <body class="signin">
        <section>
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?= base_url('assets/images/veus.png') ?>" alt="logo">
                    </div>
                    <br>
                    <p class="text-center login_text">Digite seu e-mail e senha</p>
                    <div class="mb30"></div>
                    <?= form_open(base_url('users/login'), array('name' => 'formLogin')); ?>
                    <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="E-mail">
                    </div>
                    <div class="input-group mb15">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Senha">
                    </div>
                    <div class="clearfix">
                        <div>
                            <button type="submit" class="btn btn-success btn-block">Entrar <i class="fa fa-angle-right ml5"></i></button>
                        </div>
                    </div>
                    <div style="padding-top: 20px">
                        <a href="<?= base_url('users/signup') ?>" class="btn btn-primary btn-block">Ainda não é membro? Então cadastre-se aqui.</a>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
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
