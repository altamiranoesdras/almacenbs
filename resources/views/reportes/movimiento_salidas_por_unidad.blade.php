@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    REPORTE MOVIMIENTO DE SALIDAS POR UNIDAD Y SUBSECRETARÍA
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE MOVIMIENTO DE SALIDAS POR UNIDAD Y SUBSECRETARÍA</h1>
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
                            {!! Form::open(['route' => 'reportes.movimiento.salidas.unidad', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('subsecretaria_id', 'Subsecretaría') !!}
                                        {!! Form::select('subsecretaria_id', $subsecretarias->pluck('nombre_con_padre', 'id'), $subsecretaria_id, ['class' => 'form-control select2', 'placeholder' => 'Todas las subsecretarías']) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('unidad_id', 'Unidad Solicitante') !!}
                                        {!! Form::select('unidad_id', $unidades->pluck('nombre_con_padre', 'id'), $unidad_id, ['class' => 'form-control select2', 'placeholder' => 'Todas las unidades']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label('fecha_desde', 'Fecha Desde') !!}
                                        {!! Form::date('fecha_desde', $fecha_desde, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
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

            <!-- Resumen -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resumen de Salidas</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-file-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Solicitudes</span>
                                            <span class="info-box-number">{{ $solicitudes->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Completadas</span>
                                            <span class="info-box-number">{{ $solicitudes->where('estado_id', 4)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-boxes"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Items Despachados</span>
                                            <span class="info-box-number">{{ $solicitudes->sum(function($solicitud) {
                                                return $solicitud->detalles->sum('cantidad_despachada');
                                            }) }}</span>
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
                            <h3 class="card-title">Detalle de Salidas</h3>
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
                                            <th>ID Solicitud</th>
                                            <th>Subsecretaría</th>
                                            <th>Unidad Solicitante</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Fecha Despacho</th>
                                            <th>Estado</th>
                                            <th>Items Solicitados</th>
                                            <th>Items Despachados</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($solicitudes as $solicitud)
                                            <tr>
                                                <td>{{ $solicitud->id }}</td>
                                                <td>{{ $solicitud->unidad->parent->nombre ?? 'N/A' }}</td>
                                                <td>{{ $solicitud->unidad->nombre }}</td>
                                                <td>{{ $solicitud->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $solicitud->fecha_despacha ? $solicitud->fecha_despacha->format('d/m/Y') : 'N/A' }}</td>
                                                <td>
                                                    @if($solicitud->estado_id == 1)
                                                        <span class="badge badge-info">Ingresada</span>
                                                    @elseif($solicitud->estado_id == 2)
                                                        <span class="badge badge-warning">Solicitada</span>
                                                    @elseif($solicitud->estado_id == 3)
                                                        <span class="badge badge-primary">Autorizada</span>
                                                    @elseif($solicitud->estado_id == 4)
                                                        <span class="badge badge-success">Aprobada</span>
                                                    @elseif($solicitud->estado_id == 5)
                                                        <span class="badge badge-secondary">Despachada</span>
                                                    @else
                                                        <span class="badge badge-light">{{ $solicitud->estado->nombre ?? 'N/A' }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $solicitud->detalles->sum('cantidad_solicitada') }}</td>
                                                <td class="text-center">{{ $solicitud->detalles->sum('cantidad_despachada') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="verDetalles({{ $solicitud->id }})">
                                                        <i class="fa fa-eye"></i> Ver Items
                                                    </button>
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

            <!-- Modal para ver detalles de items -->
            <div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalles de Items - Solicitud #<span id="solicitudId"></span></h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalBody">
                            <!-- Los detalles se cargarán aquí -->
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
                    "targets": [6, 7],
                    "className": "text-center"
                }
            ]
        });
    });

    function verDetalles(solicitudId) {
        $('#solicitudId').text(solicitudId);
        // Aquí se implementaría la carga de detalles via AJAX
        alert('Función para ver detalles de solicitud ID: ' + solicitudId + ' - Por implementar');
    }

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
