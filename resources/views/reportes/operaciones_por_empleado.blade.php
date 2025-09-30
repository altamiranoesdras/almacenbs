@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    REPORTE DE LISTADO DE OPERACIONES POR EMPLEADO
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE DE LISTADO DE OPERACIONES POR EMPLEADO</h1>
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
                            {!! Form::open(['route' => 'reportes.operaciones.por.empleado', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('empleado_id', 'Empleado') !!}
                                        {!! Form::select('empleado_id', $empleados->pluck('name', 'id'), $empleado_id, ['class' => 'form-control select2', 'placeholder' => 'Todos los empleados']) !!}
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
                                <div class="col-md-2">
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

            <!-- Dashboard de Estadísticas -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard de Operaciones</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-tasks"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Operaciones Asignadas</span>
                                            <span class="info-box-number">{{ $estadisticas['operaciones_asignadas'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-check-circle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Operaciones Completadas</span>
                                            <span class="info-box-number">{{ $estadisticas['operaciones_completadas'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-clock"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Operaciones en Proceso</span>
                                            <span class="info-box-number">{{ $estadisticas['operaciones_asignadas'] - $estadisticas['operaciones_completadas'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-chart-line"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Tiempo Promedio (horas)</span>
                                            <span class="info-box-number">{{ number_format($estadisticas['tiempo_promedio'], 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Rendimiento -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gráfico de Rendimiento</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="performanceChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Operaciones -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de Operaciones</h3>
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
                                            <th>Empleado</th>
                                            <th>Código Insumo</th>
                                            <th>Nombre Insumo</th>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Folio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operaciones as $operacion)
                                            <tr>
                                                <td>{{ $operacion->id }}</td>
                                                <td>{{ $operacion->usuario->name ?? 'N/A' }}</td>
                                                <td>{{ $operacion->item->codigo_insumo ?? 'N/A' }}</td>
                                                <td>{{ $operacion->item->nombre ?? 'N/A' }}</td>
                                                <td>
                                                    @if($operacion->tipo === 'ingreso')
                                                        <span class="badge badge-success">INGRESO</span>
                                                    @else
                                                        <span class="badge badge-danger">SALIDA</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">{{ number_format($operacion->cantidad, 2) }}</td>
                                                <td>{{ $operacion->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if($operacion->saldo)
                                                        <span class="badge badge-success">Completada</span>
                                                    @else
                                                        <span class="badge badge-warning">En Proceso</span>
                                                    @endif
                                                </td>
                                                <td>{{ $operacion->folio ?? 'N/A' }}</td>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                }
            ]
        });

        // Gráfico de rendimiento
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completadas', 'En Proceso', 'Pendientes'],
                datasets: [{
                    data: [
                        {{ $estadisticas['operaciones_completadas'] }},
                        {{ $estadisticas['operaciones_asignadas'] - $estadisticas['operaciones_completadas'] }},
                        {{ $estadisticas['total_operaciones'] - $estadisticas['operaciones_asignadas'] }}
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#6c757d'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
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