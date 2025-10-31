@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina','MIS EXISTENCIAS')




@section('content')
    <x-content-header titulo="MIS EXISTENCIAS">
        <a class="btn btn-outline-secondary round"
           href="{!! route('home') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body" id="root">

        @include('layouts.partials.request_errors')

        <!-- Filtros -->
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filtros</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'reportes.mis.existencias', 'method' => 'get']) !!}
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <div class="form-group" >
                                    <label for="tipos">Unidad Solicitante:</label>
                                    <multiselect v-model="unidades_seleccionadas" :options="rr_hh_unidades" label="text" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
                                    </multiselect>
                                    <input type="hidden" name="unidades_seleccionadas[]" v-for="unidad in unidades_seleccionadas" :value="unidad.id">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('fecha_desde', 'Fecha Desde') !!}
                                    {!! Form::date('fecha_desde', $fecha_desde, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('fecha_hasta', 'Fecha Hasta') !!}
                                    {!! Form::date('fecha_hasta', $fecha_hasta, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-1 text-end">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Tabla de Resultados -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Resultados</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" >
                            <table class="table table-bordered table-striped" id="tabla-reporte-existencia">
                                <thead>
                                    <tr>
                                        <th>Unidad Solicitante</th>
                                        <th>Código Insumo</th>
                                        <th>Código Presentación</th>
                                        <th>Nombre Insumo</th>
                                        <th>Presentación</th>
                                        <th>Unidad Medida</th>
                                        <th>Existencia</th>
                                        <th>Última Solicitud</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stocks as $stock)
                                        @php
                                            $ultima_solicitud = $stock->item->solicitudDetalles->sortByDesc('created_at')->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $stock->rrhhUnidad->nombre ?? 'N/A' }}</td>
                                            <td>{{ $stock->item->codigo_insumo}}</td>
                                            <td>{{ $stock->item->codigo_presentacion }}</td>
                                            <td>{{ $stock->item->nombre }}</td>
                                            <td>{{ $stock->item->presentacion->nombre ?? 'N/A' }}</td>
                                            <td>{{ $stock->item->unimed->nombre ?? 'N/A' }}</td>
                                            <td class="text-right">{{ number_format($stock->cantidad, 2) }}</td>
                                            <td>{{ $ultima_solicitud ? $ultima_solicitud->solicitud->created_at->format('d/m/Y') : 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No se encontraron resultados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        new Vue({
                el: '#root',
                name: 'root',
                created() {

                },
                mounted() {
                    cargarDatatable();
                },
                data: {

                    

                },
                methods: {

                },
                computed:{

                },
                watch:{

                }
            });

        function cargarDatatable() {
            $('#tabla-reporte-existencia').DataTable({
                dom: 'Brtip',
                paginate: false,
                ordering: true,
                language: {
                    "url": "{{asset('js/SpanishDataTables.json')}}"
                },
                buttons: [
                    {
                        extend: 'copy',
                        'text': '<i class="fa fa-copy"></i> <span class="d-none d-sm-inline">Copiar</span>'
                    },
                    {
                        extend: 'csv',
                        'text': '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">CSV</span>'
                    },
                    {
                        extend: 'excel',
                        'text': '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">Excel</span>'
                    },
                    {
                        extend: 'pdf',
                        'text': '<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>'
                    },
                    {
                        extend: 'print',
                        'text': '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'
                    },
                ],
                "order": []
            });
        }
    </script>
@endpush
