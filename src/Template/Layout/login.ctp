<?php
$cakeDescription = 'MedFarma - Medicamentos onLine.';
?>
<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>
        </title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('base') ?>
        <?= $this->Html->css('cake') ?>
        <?= $this->Html->css('style') ?>
</head>
<body class="home">
 <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->Html->image('logo_p.png'); ?> MedFarma</a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">

            </ul>
        </div>
    </nav>
<main>
    <div id="content-login">
        <div class="row">
            <div class="columns large-8 ctp-warning checks">
                <h6><b>Bem-vindo à MedFarma !</b></h6></br>
                
                Aqui, você encontrará toda a nossa linha de produtos cosméticos e medicamentos.
            </div>


            <div class="columns checks" style="width: 270px;">
                    <section>
                        <?= $this->fetch('content') ?>
                    </section>
            </div>



            </div>
        </div>
<br>
        
        </div>
        <p></p>
    </div>
  </main>  
    <footer>
        <div class="row">
            <div class="columns large-12">
            © Copyright 2017 - Cond. Parque Resd. Mal. Rondon
            </div>
        </div>
    </footer>
    
</body>
</html>
