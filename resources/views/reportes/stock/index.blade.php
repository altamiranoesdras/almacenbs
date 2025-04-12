@extends('layouts.app')

@section('titulo_pagina',__('Reporte Stock'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reporte Stock</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include('reportes.stock.filtros')
                </div>
                <!-- /.card-body -->
            </div>


            <div class="clearfix"></div>
            <div class="card card-primary">
                <div class="card-body">
                    @include('reportes.stock.table')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
@endsection

