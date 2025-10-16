@extends('layouts.app')

@section('titulo_pagina', 'Buscador ingresos operador')

@include('layouts.plugins.select2')
@include('layouts.plugins.alpinejs')

@section('content')

    <x-content-header titulo="Buscador ingresos operador" >
        <a class="btn btn-success float-right"
           href="{{ route('compras.create') }}">
            <i class="fa fa-plus"></i>
            Nueva Ingreso de Almacén
        </a>
    </x-content-header>

    <div class="content-body">
        <div class="row">
            <div class="col">
                @include('compras.operar.filtros')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @include('compras.table')
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
@endsection

