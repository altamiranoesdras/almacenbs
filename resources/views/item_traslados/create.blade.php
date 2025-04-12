@extends('layouts.app')

@section('titulo_pagina')
	Traslado enter unidades
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Nuevo Traslado Producto a Producto
                    </h1>
                </div><!-- /.col -->
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('itemTraslados.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">Listado Traslados</span>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            @include('adminlte-templates::common.errors')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'itemTraslados.store','class' => 'esperar']) !!}

                                @include('item_traslados.fields')

                                <br>
                                <div class="row">
                                        <!-- Submit Field -->
                                    <div class="col-sm-12 mb-1 text-right">
                                        <a href="{!! route('itemTraslados.index') !!}" class="btn btn-outline-secondary mr-3">Cancelar</a>
                                        <button type="submit" class="btn btn-outline-success ">Guardar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
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
