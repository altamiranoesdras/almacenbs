@extends('layouts.app')

@section('titulo_pagina',__('New Compra Tipo'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('New Compra Tipo')}}</h1>
                </div>
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('compraTipos.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">{{__('List')}}</span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            @include('layouts.partials.request_errors')

            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'compraTipos.store','class' => 'esperar']) !!}
                        <div class="row">

                            @include('compra_tipos.fields')

                            <!-- Submit Field -->
                            <div class="col-sm-12 mb-1 text-right">
                                <a href="{!! route('compraTipos.index') !!}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-outline-success">
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
