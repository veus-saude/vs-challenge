<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($product->nome) ? $product->nome : ''}}" >
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('marca') ? 'has-error' : ''}}">
    <label for="marca" class="control-label">{{ 'Marca' }}</label>
    <input class="form-control" name="marca" type="text" id="marca" value="{{ isset($product->marca) ? $product->marca : ''}}" >
    {!! $errors->first('marca', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('preco') ? 'has-error' : ''}}">
    <label for="preco" class="control-label">{{ 'Preco' }}</label>
    <input class="form-control" name="preco" type="number" id="preco" value="{{ isset($product->preco) ? $product->preco : ''}}" >
    {!! $errors->first('preco', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('estoque') ? 'has-error' : ''}}">
    <label for="estoque" class="control-label">{{ 'Estoque' }}</label>
    <input class="form-control" name="estoque" type="number" id="estoque" value="{{ isset($product->estoque) ? $product->estoque : ''}}" >
    {!! $errors->first('estoque', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
