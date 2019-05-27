@extends('default')

@section('title_user', 'Gerenciador de Marcas')

@section('header_user')
    <h1>Editar Marcas</h1>
@stop

@section('content_user')
	{{ Form::Model($brand,['url' => 'brand/edit/'.$brand->brand_id, 'method'=>'post']) }}
	@include('brand.partials.form')
@stop


