@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina')
    INGRESOS Y EGRESOS DIARIOS
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">INGRESOS Y EGRESOS DIARIOS</h1>
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
                            {!! Form::open(['route' => 'reportes.ingresos.egresos.diarios', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('fecha_desde', 'Fecha Desde') !!}
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
                            <h3 class="card-title">Resumen del Período</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-arrow-up"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Ingresos</span>
                                            <span class="info-box-number">{{ $kardex->where('tipo', 'ingreso')->sum('cantidad') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i class="fa fa-arrow-down"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Egresos</span>
                                            <span class="info-box-number">{{ $kardex->where('tipo', 'salida')->sum('cantidad') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-exchange"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Movimientos</span>
                                            <span class="info-box-number">{{ $kardex->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Días del Período</span>
                                            <span class="info-box-number">{{ \Carbon\Carbon::parse($fecha_desde)->diffInDays(\Carbon\Carbon::parse($fecha_hasta)) + 1 }}</span>
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
                            <h3 class="card-title">Detalle de Movimientos</h3>
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
                                            <th>ID Operación</th>
                                            <th>Tipo de Movimiento</th>
                                            <th>Número de Operación</th>
                                            <th>Código de Insumo</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kardex as $movimiento)
                                            <tr>
                                                <td>{{ $movimiento->id }}</td>
                                                <td>
                                                    @if($movimiento->tipo === 'ingreso')
                                                        <span class="badge badge-success">INGRESO</span>
                                                    @else
                                                        <span class="badge badge-danger">SALIDA</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movimiento->folio ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->codigo_insumo ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->nombre ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($movimiento->cantidad, 2) }}</td>
                                                <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $movimiento->responsable ?? 'N/A' }}</td>
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
                    "targets": [6],
                    "className": "text-right"
                }
            ]
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
