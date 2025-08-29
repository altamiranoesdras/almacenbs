@extends('layouts.app')

@section('titulo_pagina','Despachar Requisiciones')


@section('content')

    <x-content-header titulo="Despachar Requisiciones">
        <a class="btn btn-outline-success round"
           href="{!! route('solicitudes.usuario') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>


    <!-- Main content -->
    <div class="content-body">

        @include('layouts.errores')

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
                        @include('solicitudes.despachar.filtros')
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card">
                    @include('solicitudes.despachar.table')
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
    <!-- /.content -->
@endsection

