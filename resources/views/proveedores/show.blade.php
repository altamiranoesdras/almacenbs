@extends('layouts.app')

@section('titulo_pagina',__('Proveedor'))

@section('content')

    <x-content-header titulo="Proveedores">
        <a class="btn btn-outline-secondary float-end" href="{{ route('proveedores.index') }}">
            <i class="fa fa-arrow-left"></i>
            Regresar
        </a>
    </x-content-header>

    <div class="content-body">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-1">
                        @include('proveedores.show_fields')
                        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">
                        {{__('Back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
