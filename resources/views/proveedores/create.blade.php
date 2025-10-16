@extends('layouts.app')

@section('titulo_pagina',__('New Proveedor'))

@section('content')

    <x-content-header titulo="Proveedores">
        <a class="btn btn-outline-secondary float-end" href="{{ route('proveedores.index') }}">
            <i class="fa fa-arrow-left"></i>
            Regresar
        </a>
    </x-content-header>

    <div class="content-body">
        @include('layouts.partials.request_errors')

        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'proveedores.store','class' => 'esperar']) !!}
                    <div class="row">

                        @include('proveedores.fields')

                        <!-- Submit Field -->
                        <div class="col-sm-12 mb-1 text-end">
                            <a href="{!! route('proveedores.index') !!}" class="btn btn-outline-secondary round me-1">
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

@endsection
