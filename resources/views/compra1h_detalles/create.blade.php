@extends('layouts.app')

@section('titulo_pagina',__('New Compra1H Detalle'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('New Compra1H Detalle')}}</h1>
                </div>
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('compra1hDetalles.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">{{__('List')}}</span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content-body">
        <div class="container-fluid">

            @include('layouts.partials.request_errors')

            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'compra1hDetalles.store','class' => 'esperar']) !!}
                        <div class="row">

                            @include('compra1h_detalles.fields')

                            <!-- Submit Field -->
                            <div class="col-sm-12 mb-1 text-right">
                                <a href="{!! route('compra1hDetalles.index') !!}" class="btn btn-outline-secondary round me-1">
                                    Cancelar
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-outline-success round">
                                    <i class="fa fa-floppy-o"></i> Guardar
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
