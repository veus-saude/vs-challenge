<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/custom.js"></script>
    <script src="js/table.js"></script>
    <script src="js/datatable.js"></script>
    <script src="js/datatabledois.js"></script>
</head>
<body>
<style>
    input {
        display: block;
    }
</style>
<nav class="navbar navbar-dark bg-dark"></nav>
<div class="container">

  <div class="row" style="margin-top: 100px">
        <div class="col-md-1"></div>
        <div class="col-md-9">
        <div id="form">
            <label for="">Nome<input type="text" name="nome" id="nome"></label>
            <label for="">Marca<input type="text" name="marca" id="marca"></label>
            <label for="">Preço<input type="text" name="preco" id="preco"></label>
            <label for="">Quantidade<input type="text" name="quantidade" id="quantidade"></label>            
        </div>    
        </div><div class="col-md-1">
         <button style="margin-top: 20px" class="btn btn-secondary" onclick="submit()">Pesquisar</button>
        </div>        
        <div class="col-md-1"></div>
  </div> 
  
  <div class="row" style="margin-top: 100px">
        <div class="col-md-1"></div>
        <div class="col-md-10">      
            <table class="table table-hover display" id="table"></table>
        </div>    
        <div class="col-md-1"></div>  
   </div>   
</div>
</body>
</html>