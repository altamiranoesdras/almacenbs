@extends('layouts.app')

@section('titulo_pagina','Reporte Artículos Próximos A Vencer')

@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Reporte Artículos Próximos A Vencer">
        <a href="{{ route('home') }}" class="btn btn-default btn-sm">
            <i class="fa fa-home"></i> Inicio
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body">

        @include('items.reportes.filtros')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}
                </div>
            </div>
        </div>
            <!-- /.row -->
    </div>
    <!-- /.content -->

@endsection

@push('estilos_dt')
    @include('layouts.datatables_css')
@endpush


@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function () {
            $('#formFiltersDatatables').submit(function(e){

                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];

                table.draw();
            });
        })
    </script>
@endpush
