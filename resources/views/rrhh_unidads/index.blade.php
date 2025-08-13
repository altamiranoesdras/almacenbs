@extends('layouts.app')

@section('titulo_pagina',__('Unidades / Dependencias'))

@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Unidades / Dependencias">
        <a class="btn btn-outline-success round"
           href="{!! route('rrhhUnidades.create') !!}">
            <i class="fa fa-plus"></i>
            <span class="d-none d-sm-inline">Nueva Unidad</span>
        </a>
    </x-content-header>


    <div class="content-body">
        <div class="card card-primary">
            <div class="card-body">
                <ul class="list-group sortable">
                    @include('rrhh_unidads.partials.listado_unidades')
                </ul>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
