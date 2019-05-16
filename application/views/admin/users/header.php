<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/images/cropped-favicon-270x270.png')?>">
        <title>Veus</title>
        <?= $css ?>
    </head>
    <body>
        <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="<?= base_url('users/dashboard') ?>" class="logo">
                        <img src="<?= base_url('assets/images/veus.png') ?>" alt="" width="100px"/> 
                    </a>
                    <div class="pull-right">
                        <a href="#" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                <div class="header-right">
                    <div class="pull-right">
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="<?= base_url('users/logout') ?>"><i class="glyphicon glyphicon-log-out"></i>Deslogar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>