@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Usuario')

@include('layouts.plugins.jstree')
@include('layouts.plugins.select2')

@section('content')

    <x-content-header titulo="Nuevo Usuario">
        <a class="btn btn-outline-success round"
           href="{!! route('users.index') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="row">
            <div class="col-12">

                @include('layouts.partials.request_errors')

                <div class="card">
                    {!! Form::open(['route' => 'users.store','class' => 'esperar', "enctype"=>"multipart/form-data"]) !!}

                    <div class="card-body">

                        @include('admin.users.fields')

                    </div>

                    <div class="card-footer text-end">

                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary round me-1">
                            <i class="fa fa-ban"></i>
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success round ">
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
