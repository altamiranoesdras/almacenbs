@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina','Comparación de Kardex y Stock')

@section('content')
    <x-content-header titulo="Comparación de Kardex y Stock">
        <a class="btn btn-outline-secondary round"
           href="{!! route('home') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <div class="content-body" id="root">

        @include('layouts.partials.request_errors')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Resultados</h3>
                    </div>

                    <div class="card-body">

                        <!--tabla de insumos -->
                        <table class="table table-striped table-bordered table-hover" id="tabla_compara_kardex_stock">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Código Insumo</th>
                                    <th>Código Presentación</th>
                                    <th>Nombre</th>
                                    <th>Unidad Medida</th>
                                    <th>Saldo Kardex</th>
                                    <th>Stock Bodega Principal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($insumos as $insumo)
                                    <tr>
                                        <td>{{ $insumo->id }}</td>
                                        <td>{{ $insumo->codigo_insumo }}</td>
                                        <td>{{ $insumo->codigo_presentacion }}</td>
                                        <td>{{ $insumo->nombre }}</td>
                                        <td>{{ $insumo->unimed->nombre }}</td>
{{--                                        <td>{{ number_format($insumo->getStockSegunKardex(), 2) }}</td>--}}
                                        <td>{{ number_format($insumo->stock_total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

        });
    </script>
@endpush
