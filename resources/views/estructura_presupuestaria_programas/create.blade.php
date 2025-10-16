@extends('layouts.app')

@section('titulo_pagina', 'Crear Estructura Presupuestaria Programa')

@section('content')


    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Crear Estructura Presupuestaria Programa
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-end"
                       href="{{ url()->previous() }}"
                    >
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-12">

                @include('layouts.partials.request_errors')

                <div class="card">
                    {!! Form::open(['route' => 'estructura-presupuestaria.programas.store','class' => 'esperar']) !!}

                    <div class="card-body">

                        <div class="row">
                            @include('estructura_presupuestaria_programas.fields')
                        </div>

                    </div>

                    <div class="card-footer text-end">

                        <a href="{{ route('estructura-presupuestaria.programas.index') }}"
                           class="btn btn-outline-secondary round me-1">
                            <i class="fa fa-ban"></i>
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success round">
                            <i class="fa fa-save"></i>
                            Guardar
                        </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@endsection
