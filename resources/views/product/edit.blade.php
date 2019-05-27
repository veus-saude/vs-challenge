@extends('default')

@section('title_user', 'Gerenciador de Produtos')

@section('header_user')
    <h1>Editar produto</h1>
@stop

@section('content_user')
	{{ Form::Model($product,['url' => '/edit', 'method'=>'post']) }}
	include('product.partials.form')
@stop


