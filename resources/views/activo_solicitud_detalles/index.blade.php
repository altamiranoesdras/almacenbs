@extends('layouts.app')

@section('titulo_pagina',__('Activo Solicitud Detalles'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Activo Solicitud Detalles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item">
                            <a class="btn btn-outline-success round"
                                href="{!! route('activoSolicitudDetalles.create') !!}">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">Nuevo</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content-body">
        <div class="container-fluid">
            <div class="clearfix"></div>



            <div class="clearfix"></div>
            <div class="card card-primary">
                <div class="card-body">
                        @include('activo_solicitud_detalles.table')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
@endsection

