<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">

    <title>Veus Saude</title>
</head>
<body>
    <div class="container">
        <div id="app">
            <crud-completo source="/api/v1/produtos" title="Produtos"/>
        </div>
    </div>
</body>
    <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>

</html>
<?php /**PATH /home/felipe/Projetos/veus_saude_api/resources/views/produtos/index.blade.php ENDPATH**/ ?>