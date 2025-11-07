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

        <!-- Tabla de Resultados -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Resultados</h3>
                    </div>
                    <div class="card-body">

                        <!--pestañas "En Bodega Central" y "En mi Unidad "-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="en-bodega-central-tab" data-bs-toggle="tab" data-bs-target="#en-bodega-central" type="button" role="tab" aria-controls="en-bodega-central" aria-selected="true">
                                    En Bodega Central
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="en-mi-unidad-tab" data-bs-toggle="tab" data-bs-target="#en-mi-unidad" type="button" role="tab" aria-controls="en-mi-unidad" aria-selected="false">
                                    En mi Unidad
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="en-bodega-central" role="tabpanel" aria-labelledby="en-bodega-central-tab">
                                <p class="mt-3">Listado de insumos disponibles en la bodega central.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle" id="tabla-existencias-bodega-central">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Código Insumo</th>
                                            <th>Código Presentación</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Unidad Medida</th>
                                            <th class="text-end">Existencia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($existenciasEnBodegaCentral as $stock)
                                            <tr>
                                                <td>{{ $stock->item->codigo_insumo }}</td>
                                                <td>{{ $stock->item->codigo_presentacion }}</td>
                                                <td>{{ $stock->item->nombre }}</td>
                                                <td>{{ $stock->item->presentacion->nombre ?? 'Sin Presentación' }}</td>
                                                <td>{{ $stock->item->unimed->nombre ?? 'Sin Unidad' }}</td>
                                                <td class="text-end">{{ nf($stock->cantidad, 0) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No se encontraron resultados</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="en-mi-unidad" role="tabpanel" aria-labelledby="en-mi-unidad-tab">
                                <p class="mt-3">Listado de insumos disponibles en mi unidad.</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle" id="tabla-existencias-unidad">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Código Insumo</th>
                                            <th>Código Presentación</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Unidad Medida</th>
                                            <th class="text-end">Existencia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($existenciasEnBodegaDeUnidad as $stock)
                                            <tr>
                                                <td>{{ $stock->item->codigo_insumo }}</td>
                                                <td>{{ $stock->item->codigo_presentacion }}</td>
                                                <td>{{ $stock->item->nombre }}</td>
                                                <td>{{ $stock->item->presentacion->nombre ?? 'Sin Presentación' }}</td>
                                                <td>{{ $stock->item->unimed->nombre ?? 'Sin Unidad' }}</td>
                                                <td class="text-end">{{ nf($stock->cantidad, 0) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No se encontraron resultados</td>
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
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#tabla-existencias-bodega-central').DataTable({
                dom: 'Brtip',
                paginate: false,
                ordering: true,
                language: {
                    "url": "{{asset('js/SpanishDataTables.json')}}",
                    "emptyTable": "No se encontraron resultados",
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

            $('#tabla-existencias-unidad').DataTable({
                dom: 'Brtip',
                paginate: false,
                ordering: true,
                language: {
                    "url": "{{asset('js/SpanishDataTables.json')}}",
                    "emptyTable": "No se encontraron resultados",
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
        })
    </script>
@endpush
