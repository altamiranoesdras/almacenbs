@extends('layouts.app')

@section('titulo_pagina', 'Nueva opción')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Nueva opción</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('dev.options.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">Listado</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">


        @include('layouts.partials.request_errors')

        <div class="card">
            {!! Form::model($option, ['route' => ['dev.option.update', $option->id], 'method' => 'patch','class' => 'esperar']) !!}

            <div class="card-body">

                <div class="row">

                    @include('admin.options.fields')

                </div>

            </div>
            <div class="card-footer">
                <!-- Submit Field -->
                <div class="col-sm-12 text-end">

                    <a href="{!! route('dev.options.index') !!}" class="btn btn-outline-secondary me-1">
                        <i class="fa fa-ban"></i>
                        Cancelar
                    </a>

                    <button type="submit"  class="btn btn-outline-success round">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection



