@extends('default')

@section('title_user', 'Gerenciador de Produtos')

@section('header_user')
    <h1>Criar produto</h1>
@stop

@section('content_user')
	{{ Form::open(['url' => '/add', 'method'=>'post']) }}
	@include('product.partials.form')
@stop


