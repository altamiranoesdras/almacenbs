@extends('layouts.app')

@section('titulo_pagina')
    LISTADO DE COMPRAS
@endsection

@include('layouts.plugins.select2')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Página en construcción</h1>
                </div><!-- /.col -->
                <div class="col">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">

                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-lg-12 col-12 mb-3">
                <div class="card ">
                    <!-- /.card-header -->
                    <div class="card-body text-center">
                        <img src="{{ asset('img/en_construccion.jpeg') }}" class="img-fluid" style="max-width: 40%">
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
