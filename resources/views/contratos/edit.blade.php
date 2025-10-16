@extends('layouts.app')

@section('titulo_pagina',__('Edit Contrato'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1>{{__('Edit Contrato')}}</h1>
                </div>
                <div class="col">
                    <a class="btn btn-outline-info float-end"
                       href="{{route('contratos.index')}}">
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

                   {!! Form::model($contrato, ['route' => ['contratos.update', $contrato->id], 'method' => 'patch','class' => 'esperar']) !!}
                        <div class="row">

                            @include('contratos.fields')

                            <!-- Submit Field -->
                            <div class="col-sm-12 mb-1 text-end">
                                <a href="{!! route('contratos.index') !!}" class="btn btn-outline-secondary round me-1">
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
