@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-primary">
	<div class="box-body">
		<div class="form-group">
			{{Form::label('product_name', 'Nome')}}
			{{Form::text('product_name', null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('brand_id', 'Marca')}}
			{{Form::select('brand_id', $brand_list ,null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('product_price', 'Preço')}}
			{{Form::text('product_price', null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('product_qty', 'Quantidade')}}
			{{Form::number('product_qty', null, ['class'=>'form-control'])}}
		</div>
	</div>
	<!-- /.box-body -->

	<div class="box-footer">
	<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
{{ Form::close() }}