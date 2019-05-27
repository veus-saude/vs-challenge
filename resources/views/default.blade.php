@extends('adminlte::page')

@section('title')
	@yield('title_user')
@stop

@section('content_header')    
	@yield('header_user')
@stop

@section('content')
    @yield('content_user')
@stop

@stack('css')

@stack('js')    