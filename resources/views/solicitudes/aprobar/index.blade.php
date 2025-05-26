@extends('layouts.app')

@section('titulo_pagina','Aprobar requisiciones')


@section('content')

    <x-content-header titulo="Aprobar requisiciones">
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
                <div class="card">
                    @include('solicitudes.aprobar.table')
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
    <!-- /.content -->
@endsection

