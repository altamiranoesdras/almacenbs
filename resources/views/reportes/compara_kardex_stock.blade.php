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

                        {{-- Filtros de cuadre --}}
                        <div class="d-flex align-items-center flex-wrap">
                            <span class="me-2 fw-semibold">Filtrar por cuadre:</span>

                            <div class="form-check form-check-inline mb-0">
                                <input class="form-check-input filtro-cuadra" type="radio"
                                       name="filtro_cuadra" id="filtro_cuadran" value="cuadran">
                                <label class="form-check-label" for="filtro_cuadran">
                                    Que cuadran
                                </label>
                            </div>

                            <div class="form-check form-check-inline mb-0">
                                <input class="form-check-input filtro-cuadra" type="radio"
                                       name="filtro_cuadra" id="filtro_no_cuadran" value="no_cuadran">
                                <label class="form-check-label" for="filtro_no_cuadran">
                                    Que no cuadran
                                </label>
                            </div>

                            <a href="#" id="filtro_cuadra_reset" class="ms-3 small text-decoration-underline">
                                Ver todos
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <!-- tabla de insumos -->
                            <table class="table table-striped table-sm table-bordered table-hover mb-0"
                                   id="tabla_compara_kardex_stock">
                                <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Código Insumo</th>
                                    <th>Código Presentación</th>
                                    <th>Nombre</th>
                                    <th>Unidad Medida</th>
                                    <th class="text-end">Saldo Kardex</th>
                                    <th class="text-end">Stock Bodega Principal</th>
                                    <th class="text-center">Cuadra</th>
                                    <th class="text-end">Diferencia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($insumos as $insumo)
                                    @php
                                        $saldo_kardex = $insumo->getStockSegunKardex();
                                        $saldoStock = $insumo->stock_total;
                                        $cuadra = $saldo_kardex == $saldoStock ? 'Si cuadra' : 'No cuadra';
                                        $diferencia = $saldo_kardex - $saldoStock;
                                    @endphp
                                    <tr>
                                        <td>{{ $insumo->id }}</td>
                                        <td>{{ $insumo->codigo_insumo }}</td>
                                        <td>{{ $insumo->codigo_presentacion }}</td>
                                        <td>{{ $insumo->nombre }}</td>
                                        <td>{{ $insumo->unimed->nombre }}</td>
                                        <td class="text-end">{{ number_format($saldo_kardex, 2) }}</td>
                                        <td class="text-end">{{ number_format($saldoStock, 2) }}</td>
                                        <td class="text-center">
                                            @if($cuadra === 'Si cuadra')
                                                <span class="badge bg-success">{{ $cuadra }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $cuadra }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">{{ number_format($diferencia, 2) }}</td>
                                    </tr>
                                @endforeach
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
        $(function () {

            // Filtro personalizado por columna "Cuadra"
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                // Solo aplicar a esta tabla
                if (settings.nTable.id !== 'tabla_compara_kardex_stock') {
                    return true;
                }

                const filtro = $('input[name="filtro_cuadra"]:checked').val();
                const estadoCuadra = (data[7] || '').trim(); // columna "Cuadra"

                if (!filtro || filtro === '') {
                    // Sin filtro -> mostrar todos
                    return true;
                }

                if (filtro === 'cuadran') {
                    return estadoCuadra === 'Si cuadra';
                }

                if (filtro === 'no_cuadran') {
                    return estadoCuadra === 'No cuadra';
                }

                return true;
            });

            const tabla = $('#tabla_compara_kardex_stock').DataTable({
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
                autoWidth: false,
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
                order: [[0, 'asc']],
                language: {
                    url: "{{ asset('plugins/datatables/lang/es.json') }}"
                },
                columnDefs: [
                    { orderable: false, targets: [7, 8] }
                ]
            });

            // Redibujar al cambiar el radio
            $('.filtro-cuadra').on('change', function () {
                tabla.draw();
            });

            // Botón "Ver todos"
            $('#filtro_cuadra_reset').on('click', function (e) {
                e.preventDefault();
                $('input[name="filtro_cuadra"]').prop('checked', false);
                tabla.draw();
            });

        });
    </script>
@endpush
