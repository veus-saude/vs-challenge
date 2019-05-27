@extends('default')

@section('title_user', 'Gerenciador de Marcas')

@section('header_user')
    <h1>Criar marca</h1>
@stop

@section('content_user')
	{{ Form::open(['url' => 'brand/add', 'method'=>'post']) }}
	@include('brand.partials.form')
@stop


