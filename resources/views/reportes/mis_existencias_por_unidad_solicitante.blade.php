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

    <div class="content-body" id="root">

        @include('layouts.partials.request_errors')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Resultados</h3>
                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filtro-existencias" type="radio" name="filtroExistencias" id="filtro-todos" value="todos" checked>
                                <label class="form-check-label" for="filtro-todos">Todos</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filtro-existencias" type="radio" name="filtroExistencias" id="filtro-con" value="con">
                                <label class="form-check-label" for="filtro-con">Con existencias</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input filtro-existencias" type="radio" name="filtroExistencias" id="filtro-sin" value="sin">
                                <label class="form-check-label" for="filtro-sin">Sin existencias</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-top border" id="en-bodega-central-tab"
                                        data-bs-toggle="tab" data-bs-target="#en-bodega-central"
                                        type="button" role="tab">
                                    En Bodega Central
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-top border" id="en-mi-unidad-tab"
                                        data-bs-toggle="tab" data-bs-target="#en-mi-unidad"
                                        type="button" role="tab">
                                    En mi Unidad
                                </button>
                            </li>
                        </ul>


                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active border" id="en-bodega-central" role="tabpanel">
                                <p class="p-1 mb-0">Listado de insumos disponibles en la bodega central.</p>
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

                            <div class="tab-pane fade border" id="en-mi-unidad" role="tabpanel">
                                <p class="p-1 mb-0">Listado de insumos disponibles en mi unidad.</p>
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
@endsection

@push('scripts')
    <script>
        $(function () {
            const tablas = [
                $('#tabla-existencias-bodega-central').DataTable({
                    dom: `
                    <"d-flex justify-content-between align-items-center mx-0 row"
                        <"col-sm-12 col-md-6 dt-action-buttons text-start"B>
                        <"col-sm-12 col-md-6 text-end"f>
                    >
                    t
                    <"d-flex justify-content-between mx-0 row"
                        <"col-sm-12"i>
                    >
                    `,
                    paginate: false,
                    ordering: true,
                    language: { url: "{{asset('js/SpanishDataTables.json')}}", emptyTable: "No se encontraron resultados" },
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fa fa-copy"></i> Copiar'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel"></i> Excel'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf"></i> PDF',
                            customize: function (doc) {
                                const fecha = new Date().toLocaleString('es-GT');

                                // Márgenes para permitir footer
                                doc.pageMargins = [40, 40, 40, 60];

                                // Footer del PDF
                                doc.footer = function (currentPage, pageCount) {
                                    return {
                                        columns: [
                                            {
                                                text: `Generado el: ${fecha}`,
                                                alignment: 'left',
                                                fontSize: 9,
                                                margin: [40, 0]
                                            },
                                            {
                                                text: `Página ${currentPage} de ${pageCount}`,
                                                alignment: 'right',
                                                fontSize: 9,
                                                margin: [0, 0, 40, 0]
                                            }
                                        ]
                                    };
                                };
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Imprimir',
                            customize: function (win) {
                                const fecha = new Date().toLocaleString('es-GT');

                                // Footer en impresión
                                $(win.document.body).append(`
                <div style="position:fixed; bottom:20px; width:100%; text-align:right; font-size:12px;">
                    Impreso el: ${fecha}
                </div>
            `);
                            }
                        }
                    ],
                    order: []
                }),

                $('#tabla-existencias-unidad').DataTable({
                    dom: `
                    <"d-flex justify-content-between align-items-center mx-0 row"
                        <"col-sm-12 col-md-6 dt-action-buttons text-start"B>
                        <"col-sm-12 col-md-6 text-end"f>
                    >
                    t
                    <"d-flex justify-content-between mx-0 row"
                        <"col-sm-12"i>
                    >
                    `,
                    paginate: false,
                    ordering: true,
                    language: { url: "{{asset('js/SpanishDataTables.json')}}", emptyTable: "No se encontraron resultados" },
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fa fa-copy"></i> Copiar'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel"></i> Excel'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-file-pdf"></i> PDF',
                            customize: function (doc) {
                                const fecha = new Date().toLocaleString('es-GT');

                                // Márgenes para permitir footer
                                doc.pageMargins = [40, 40, 40, 60];

                                // Footer del PDF
                                doc.footer = function (currentPage, pageCount) {
                                    return {
                                        columns: [
                                            {
                                                text: `Generado el: ${fecha}`,
                                                alignment: 'left',
                                                fontSize: 9,
                                                margin: [40, 0]
                                            },
                                            {
                                                text: `Página ${currentPage} de ${pageCount}`,
                                                alignment: 'right',
                                                fontSize: 9,
                                                margin: [0, 0, 40, 0]
                                            }
                                        ]
                                    };
                                };
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Imprimir',
                            customize: function (win) {
                                const fecha = new Date().toLocaleString('es-GT');

                                // Footer en impresión
                                $(win.document.body).append(`
                <div style="position:fixed; bottom:20px; width:100%; text-align:right; font-size:12px;">
                    Impreso el: ${fecha}
                </div>
            `);
                            }
                        }
                    ],
                    order: []
                })
            ];

            // Filtro por existencia
            $('.filtro-existencias').on('change', function () {
                const filtro = $(this).val();

                tablas.forEach(tabla => {
                    tabla.rows().every(function () {
                        const cantidad = parseFloat($(this.node()).find('td:last').text().replace(/,/g, '')) || 0;

                        if (filtro === 'con' && cantidad <= 0) {
                            $(this.node()).hide();
                        } else if (filtro === 'sin' && cantidad > 0) {
                            $(this.node()).hide();
                        } else {
                            $(this.node()).show();
                        }
                    });
                });
            });
        });
    </script>
@endpush
