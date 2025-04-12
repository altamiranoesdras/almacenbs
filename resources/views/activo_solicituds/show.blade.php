@extends('layouts.app')

@section('titulo_pagina')
    Solicitud Activos
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Solicitud Activos
                    </h1>
                </div><!-- /.col -->
                <div class="col">

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-compra" data-toggle="pill"
                                       href="#custom-tabs-four-home" role="tab"
                                       aria-controls="custom-tabs-four-home" aria-selected="true">
                                        Solicitud Activos
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                     aria-labelledby="tab-compra">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('activo_solicituds.show_fields')
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('activo_solicituds.tabla_detalles',['detalles'=>$activoSolicitud->detalles])
                                        </div>

                                        <div class="col-sm-12 mb-1 text-right">
                                            <a href="{!! route('activoSolicitudes.index') !!}" class="btn btn-outline-secondary">Regresar</a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
