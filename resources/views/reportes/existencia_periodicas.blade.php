@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    EXISTENCIA PERIÓDICAS (SEMANALES Y MENSUALES)
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">EXISTENCIA PERIÓDICAS (SEMANALES Y MENSUALES)</h1>
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
                            {!! Form::open(['route' => 'reportes.existencia.periodicas', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tipo_periodo', 'Tipo de Período') !!}
                                        {!! Form::select('tipo_periodo', [
                                            'semanal' => 'Semanal',
                                            'mensual' => 'Mensual'
                                        ], $tipo_periodo, ['class' => 'form-control select2']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('fecha_especifica', 'Fecha Específica') !!}
                                        {!! Form::date('fecha_especifica', $fecha_especifica, ['class' => 'form-control']) !!}
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

            <!-- Información del Período -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                @if($tipo_periodo === 'semanal')
                                    Período Semanal: {{ \Carbon\Carbon::parse($fecha_especifica)->startOfWeek()->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fecha_especifica)->endOfWeek()->format('d/m/Y') }}
                                @else
                                    Período Mensual: {{ \Carbon\Carbon::parse($fecha_especifica)->format('m/Y') }}
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Resultados -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resultados</h3>
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
                                            <th>Solicitudes en Período</th>
                                            <th>Última Solicitud</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            @php
                                                $unidades_solicitantes = $item->solicitudDetalles->pluck('solicitud.unidad.nombre')->unique();
                                                $solicitudes_periodo = $item->solicitudDetalles->filter(function($detalle) use ($tipo_periodo, $fecha_especifica) {
                                                    $fecha = $detalle->created_at;
                                                    if ($tipo_periodo === 'semanal') {
                                                        return $fecha->between(
                                                            \Carbon\Carbon::parse($fecha_especifica)->startOfWeek(),
                                                            \Carbon\Carbon::parse($fecha_especifica)->endOfWeek()
                                                        );
                                                    } else {
                                                        return $fecha->month === \Carbon\Carbon::parse($fecha_especifica)->month &&
                                                               $fecha->year === \Carbon\Carbon::parse($fecha_especifica)->year;
                                                    }
                                                });
                                                $ultima_solicitud = $item->solicitudDetalles->sortByDesc('created_at')->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $unidades_solicitantes->implode(', ') }}</td>
                                                <td>{{ $item->codigo_insumo }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($item->stock_total, 2) }}</td>
                                                <td class="text-center">{{ $solicitudes_periodo->count() }}</td>
                                                <td>{{ $ultima_solicitud ? $ultima_solicitud->solicitud->created_at->format('d/m/Y') : 'N/A' }}</td>
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
                    "targets": [6],
                    "className": "text-center"
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