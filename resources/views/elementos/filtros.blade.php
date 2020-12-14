<h3>Filtros</h3>
<hr />
<div class="form-row">
    <div class="col-3">
        <div class="form-group">
            <label for="inputEmail4">Nomo do Produto</label>
            <input type="text" class="form-control" id="q">
        </div>                
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="inputEmail4">Marca</label>
            <input type="text" class="form-control" id="brand">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="inputEmail4">Preco</label>
            <input type="text" class="form-control" id="preco">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="inputEmail4">Estoque</label>
            <input type="text" class="form-control" id="qtd_estoque">
        </div>
    </div>            
    <div class="col-2">
        <div class="form-group">
            <label for="inputEmail4">Ordenar</label>
            <select name="ordenar" id="ordenar" class="form-control">
                <option value="preco:asc">Menor Preco</option>
                <option value="preco:desc">Maior Preco</option>
                <option value="nome:asc">Ordem Alfabetica</option>
            </select>
        </div>
    </div>
    <div class="col-1">
        <button type="button" id="buscar" class="btn btn-primary" style="margin-top: 30px">Buscar</button>
    </div>
</div>