@extends('layouts.app')

@section('titulo_pagina',__('Proveedores'))

@section('content')

    <!-- Content Header (Page header) -->

    <x-content-header titulo="Proveedores">
        <a class="btn btn-primary float-right" href="{{ route('proveedores.create') }}">
            <i class="fa fa-plus"></i>
            {{ __('Nuevo proveedor') }}
        </a>
    </x-content-header>


    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('proveedores.table')
                </div>
            </div>
        </div>

    </div>
@endsection

