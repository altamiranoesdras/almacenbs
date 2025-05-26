@extends('layouts.app')

@section('titulo_pagina','Autorizar requisiciones')


@section('content')

    <x-content-header titulo="Autorizar requisiciones" >
        <a href="{{ route('solicitudes.index') }}" class="btn btn-outline-success round">
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
                    <div class="card-body">
                       @include('solicitudes.autorizar.table')
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
    <!-- /.content -->
@endsection

