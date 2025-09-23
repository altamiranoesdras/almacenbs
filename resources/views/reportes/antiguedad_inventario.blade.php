@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    REPORTE DE ANTIGÜEDAD DE INVENTARIO (EXISTENCIAS)
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE DE ANTIGÜEDAD DE INVENTARIO (EXISTENCIAS)</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-body" id="root">
        <div class="container-fluid">
            @include('layouts.partials.request_errors')

            <!-- Filtros -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filtros</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'reportes.antiguedad.inventario', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('fecha_desde', 'Fecha Desde (Ingreso)') !!}
                                        {!! Form::date('fecha_desde', $fecha_desde, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('fecha_hasta', 'Fecha Hasta') !!}
                                        {!! Form::date('fecha_hasta', $fecha_hasta, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-search"></i> Generar Reporte
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resumen de Antigüedad</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-boxes"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Items</span>
                                            <span class="info-box-number">{{ $items->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-calendar-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Promedio Antigüedad</span>
                                            <span class="info-box-number">{{ round($items->avg(function($item) {
                                                return $item->stocks->min('fecha_ing') ? now()->diffInDays($item->stocks->min('fecha_ing')) : 0;
                                            }), 0) }} días</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-exclamation-triangle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Más Antiguo</span>
                                            <span class="info-box-number">{{ $items->max(function($item) {
                                                return $item->stocks->min('fecha_ing') ? now()->diffInDays($item->stocks->min('fecha_ing')) : 0;
                                            }) }} días</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-chart-line"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Existencia Total</span>
                                            <span class="info-box-number">{{ number_format($items->sum('stock_total'), 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Resultados -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de Antigüedad</h3>
                            <div class="card-tools">
                                <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                                    <i class="fa fa-file-excel"></i> Exportar Excel
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="exportToPDF()">
                                    <i class="fa fa-file-pdf"></i> Exportar PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="reportTable">
                                    <thead>
                                        <tr>
                                            <th>ID Insumo</th>
                                            <th>Unidad Solicitante</th>
                                            <th>Código Insumo</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Existencia</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Días en Bodega</th>
                                            <th>Estado Antigüedad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            @php
                                                $fecha_ingreso = $item->stocks->min('fecha_ing');
                                                $dias_bodega = $fecha_ingreso ? now()->diffInDays($fecha_ingreso) : 0;
                                                $estado_antiguedad = $dias_bodega > 365 ? 'Antiguo (>1 año)' :
                                                                   ($dias_bodega > 180 ? 'Mediano (6 meses)' : 'Reciente (<6 meses)');
                                                $badge_class = $dias_bodega > 365 ? 'danger' :
                                                              ($dias_bodega > 180 ? 'warning' : 'success');
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->solicitudDetalles->pluck('solicitud.unidad.nombre')->first() ?? 'N/A' }}</td>
                                                <td>{{ $item->codigo_insumo }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($item->stock_total, 2) }}</td>
                                                <td>{{ $fecha_ingreso ? $fecha_ingreso->format('d/m/Y') : 'N/A' }}</td>
                                                <td class="text-center">{{ $dias_bodega }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $badge_class }}">{{ $estado_antiguedad }}</span>
                                                </td>
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
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
            "paging": true,
            "searching": true,
            "info": true,
            "language": {
                "url": "{{ asset('js/SpanishDataTables.json') }}"
            },
            "columnDefs": [
                {
                    "targets": [5],
                    "className": "text-right"
                },
                {
                    "targets": [7],
                    "className": "text-center"
                }
            ],
            "order": [[7, "desc"]] // Ordenar por días en bodega descendente
        });
    });

    function exportToExcel() {
        // Implementar exportación a Excel
        alert('Función de exportación a Excel - Por implementar');
    }

    function exportToPDF() {
        // Implementar exportación a PDF
        alert('Función de exportación a PDF - Por implementar');
    }
</script>
@endpush