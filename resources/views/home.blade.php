@extends('adminlte::page')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@inject('products', "App\\Product")
@inject('users', "App\\User")

@section('content')
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-basket"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Products</span>
                <span class="info-box-number">{{ $products->count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{ $users->count() }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
@stop