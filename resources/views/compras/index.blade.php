@extends('layouts.app')

@section('titulo_pagina', 'Buscar Ingresos a Almacén')

@include('layouts.plugins.select2')
@include('layouts.plugins.alpinejs')


@section('content')


    <x-content-header titulo="Buscar Ingresos a Almacén">
        <a class="btn btn-success float-right"
           href="{{ route('compras.create') }}">
            <i class="fa fa-plus"></i>
            Nueva Ingreso de Almacén
        </a>
    </x-content-header>

    <div class="content-body">
        <div class="row">
            <div class="col-lg-12">
                @include('compras.filtros')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        @include('compras.table')
                        <h3 class="text-muted">
                            Total <span id="count_rows"></span>   registros  <span class="text-success"><span id="total_filtro"></span></span>
                        </h3>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
@endsection

