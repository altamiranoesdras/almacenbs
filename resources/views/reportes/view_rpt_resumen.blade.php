@extends('layouts.app')

@section('titulo_pagina')
    Resumen financiero
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Resumen financiero</h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right" href="{!! route('dashboard') !!}">
                        <i class="fa fa-tachometer-alt"></i>
                        <span class="d-none d-sm-inline">Dashboard</span>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-body">
        <div class="container-fluid">



            @include('adminlte-templates::common.errors')

            <div class="row">
                <div class="col-sm-12 ">
                    @include('reportes.resumen.diario.box_totales')
                </div>

                <div class="col-sm-3 ">
                    @include('reportes.resumen.diario.box_ventas_cat')
                </div>

                <div class="col-sm-3 ">
                    @include('reportes.resumen.diario.pagos_ventas_credito')
                </div>

                <div class="col-sm-3">
                    @include('reportes.resumen.diario.box_gastos')
                </div>

                <div class="col-sm-3">
                    @include('reportes.resumen.diario.box_consumos')
                </div>
            </div>

{{--            @include('cuadres.modal_cuadre')--}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

