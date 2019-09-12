<!DOCTYPE html>
<html lang="pt-BR" >
<head>
	<?php
		$cakeDescription = 'MedFarma - Medicamentos onLine.';
	?>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <title><?= $cakeDescription ?></title>

    <?= $this->Html->meta('icon') ?>

    	<?= $this->Html->css('base.css') ?>
    	<?= $this->Html->css('cake.css') ?>
    	<?= $this->Html->css('style.css') ?>
        <?= $this->Html->css('jquery-ui') ?>
        <?= $this->Html->css('font-awesome.min') ?>

        <?= $this->Html->script('jquery.min') ?>
        <?= $this->Html->script('jquery-1.12.4') ?>
        <?= $this->Html->script('jquery-ui') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('js') ?>
        <?= $this->fetch('script') ?>

</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->Html->image('logo_p.png'); ?> MedFarma</a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <div class="col-md-12" style="text-align: right; background: #116d76; color: white; padding-top: 7px; padding-right: 15px;">
                Usuário: <b><?= $this->request->session()->read('Auth.User.username') ?></b> &nbsp;&nbsp;&nbsp;&nbsp; 
                
                        <?= $this->Html->image('sair.png', array('title' => "Sair", 'url' => array('controller' => 'Users', 'action' => 'logout'), array('escape' => false, 'confirm' => __('Are you sure you want to leave the Site?')))); ?>
            </div>
            </ul>
        </div>
    </nav>
        <div class="container clearfix">
            <div class="columns large-3">
                <nav class=" columns" id="actions-sidebar">
                    <ul class="side-nav">

                    <?= $this->element('menu-config'); ?>

                    </ul>
                </nav>
            </div>
            <div class="columns large-9" style="align-content: center;">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            </div>
        </div>
    <footer>
            <div class="row">
                <div class="columns large-12">
                    � Copyright 2019 - MedFarma.
                </div>
            </div>
    </footer>
</body>
</html>
