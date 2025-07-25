@extends('layouts.app')

@section('titulo_pagina')
	Requisiciones
@endsection

@section('content')
    <!-- Content Header (Page header) -->
{{--    <div class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <h1 class="m-0 text-dark">Requisiciones</h1>--}}
{{--                </div><!-- /.col -->--}}
{{--                <div class="col">--}}
{{--                    <ol class="breadcrumb float-right">--}}
{{--                        <li class="breadcrumb-item">--}}
{{--                            <a class="btn btn-outline-success round"--}}
{{--                                href="{!! route('solicitudes.create') !!}">--}}
{{--                                <i class="fa fa-plus"></i>--}}
{{--                                <span class="d-none d-sm-inline">Agregar Nueva</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ol>--}}
{{--                </div><!-- /.col -->--}}
{{--            </div><!-- /.row -->--}}
{{--        </div><!-- /.container-fluid -->--}}
{{--    </div>--}}
    <x-content-header titulo="Requisiciones">
        <a class="btn btn-success float-right"
           href="{!! route('solicitudes.create') !!}"
        >
            <i class="fa fa-plus"></i>
            Nueva Requisición
        </a>
    </x-content-header>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-body">
{{--        <div class="container-fluid">--}}


            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Filtros</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('solicitudes.filtros')
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                           @include('solicitudes.table')
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
{{--        </div>--}}
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

