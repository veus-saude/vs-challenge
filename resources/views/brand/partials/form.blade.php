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
			{{Form::label('brand_name', 'Nome')}}
			{{Form::text('brand_name', null, ['class'=>'form-control'])}}
		</div>
	</div>
	<!-- /.box-body -->

	<div class="box-footer">
	<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
{{ Form::close() }}