@extends('layouts.app')

@section('titulo_pagina',__('Nueva Unidad / Dependencia'))
@include('layouts.plugins.select2')
@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Nueva Unidad / Dependencia">
        <a class="btn btn-outline-info float-right"
           href="{{route('rrhhUnidades.index')}}">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">{{__('List')}}</span>
        </a>
    </x-content-header>

    <div class="content-body">

            @include('layouts.partials.request_errors')

            <div class="card">
                {!! Form::open(['route' => 'rrhhUnidades.store','class' => 'esperar']) !!}

                <div class="card-body">
                        <div class="row">

                            @include('rrhh_unidads.fields')


                        </div>
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 mb-1 text-end">
                        <a href="{!! route('rrhhUnidades.index') !!}" class="btn btn-outline-secondary round me-1">
                            Cancelar
                        </a>
                        &nbsp;
                        <button type="submit" class="btn btn-success round">
                            <i class="fa fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
    </div>

@endsection
