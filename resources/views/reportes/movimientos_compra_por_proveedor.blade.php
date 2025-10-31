@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina')
    REPORTE DE MOVIMIENTOS DE COMPRA POR PROVEEDOR
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE DE MOVIMIENTOS DE COMPRA POR PROVEEDOR</h1>
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
                            {!! Form::open(['route' => 'reportes.movimientos.compra.proveedor', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('proveedor_id', 'Proveedor') !!}
                                        {!! Form::select('proveedor_id', $proveedores->pluck('nombre', 'id'), $proveedor_id, ['class' => 'form-control select2', 'placeholder' => 'Todos los proveedores']) !!}
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

            <!-- Resumen -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resumen de Compras</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Compras</span>
                                            <span class="info-box-number">{{ $compras->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-dollar-sign"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Monto Total</span>
                                            <span class="info-box-number">${{ number_format($compras->sum('total'), 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-boxes"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Items Comprados</span>
                                            <span class="info-box-number">{{ $compras->sum(function($compra) {
                                                return $compra->detalles->sum('cantidad');
                                            }) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Promedio por Compra</span>
                                            <span class="info-box-number">${{ $compras->count() > 0 ? number_format($compras->sum('total') / $compras->count(), 2) : '0.00' }}</span>
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
                            <h3 class="card-title">Detalle de Compras</h3>
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
                                            <th>ID Compra</th>
                                            <th>Proveedor</th>
                                            <th>Documento</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Estado</th>
                                            <th>Items</th>
                                            <th>Monto Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($compras as $compra)
                                            <tr>
                                                <td>{{ $compra->id }}</td>
                                                <td>{{ $compra->proveedor->nombre }}</td>
                                                <td>{{ $compra->serie }}-{{ $compra->numero }}</td>
                                                <td>{{ $compra->fecha_ingreso->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($compra->estado_id == 1)
                                                        <span class="badge badge-success">Ingresado</span>
                                                    @elseif($compra->estado_id == 2)
                                                        <span class="badge badge-warning">Pendiente</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ $compra->estado->nombre ?? 'N/A' }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $compra->detalles->count() }}</td>
                                                <td class="text-right">${{ number_format($compra->total, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" onclick="verDetalles({{ $compra->id }})">
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
                            <h5 class="modal-title">Detalles de Items</h5>
                            <button type="button" class="close" data-bs-dismiss="modal">
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
                    "targets": [5, 6],
                    "className": "text-center"
                },
                {
                    "targets": [6],
                    "className": "text-right"
                }
            ]
        });
    });

    function verDetalles(compraId) {
        // Implementar vista de detalles
        alert('Función para ver detalles de compra ID: ' + compraId + ' - Por implementar');
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
