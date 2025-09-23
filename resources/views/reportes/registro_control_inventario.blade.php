@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    REPORTE DE REGISTRO DE CONTROL DE INVENTARIO
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE DE REGISTRO DE CONTROL DE INVENTARIO</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-body" id="root">
        <div class="container-fluid">
            @include('layouts.partials.request_errors')

            <!-- Información del Reporte -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Control de Inventario Físico</h3>
                            <div class="card-tools">
                                <button class="btn btn-info btn-sm" onclick="imprimirFormato()">
                                    <i class="fa fa-print"></i> Imprimir Formato
                                </button>
                                <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                                    <i class="fa fa-file-excel"></i> Exportar Excel
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="exportToPDF()">
                                    <i class="fa fa-file-pdf"></i> Exportar PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h5><i class="fa fa-info-circle"></i> Instrucciones:</h5>
                                <p>Este reporte sirve para realizar la toma física de inventario. Complete las columnas de "Inventario Físico" y "Observaciones" según corresponda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resumen General</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fa fa-boxes"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Items</span>
                                            <span class="info-box-number">{{ $items->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Con Existencia</span>
                                            <span class="info-box-number">{{ $items->where('stock_total', '>', 0)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-exclamation-triangle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Sin Existencia</span>
                                            <span class="info-box-number">{{ $items->where('stock_total', '=', 0)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-calculator"></i></span>
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

            <!-- Tabla de Control de Inventario -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Formato de Control de Inventario</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="reportTable">
                                    <thead>
                                        <tr>
                                            <th>ID Insumo</th>
                                            <th>Código Insumo</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Unidad Medida</th>
                                            <th>Existencia Sistema</th>
                                            <th>Inventario Físico</th>
                                            <th>Diferencia</th>
                                            <th>Observaciones</th>
                                            <th>Verificación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->codigo_insumo }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td>{{ $item->unimed->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($item->stock_total, 2) }}</td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control form-control-sm inventario-fisico"
                                                           data-item-id="{{ $item->id }}" step="0.01" min="0"
                                                           placeholder="0.00" style="width: 100px;">
                                                </td>
                                                <td class="text-right diferencia" data-item-id="{{ $item->id }}">
                                                    0.00
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm observaciones"
                                                           data-item-id="{{ $item->id }}" placeholder="Observaciones">
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input verificacion"
                                                           data-item-id="{{ $item->id }}">
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

            <!-- Acciones Finales -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block" onclick="guardarInventario()">
                                        <i class="fa fa-save"></i> Guardar Inventario Físico
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block" onclick="finalizarInventario()">
                                        <i class="fa fa-check"></i> Finalizar y Generar Reporte
                                    </button>
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
                    "targets": [5, 6, 7],
                    "className": "text-right"
                },
                {
                    "targets": [8],
                    "className": "text-center"
                }
            ]
        });

        // Calcular diferencias automáticamente
        $('.inventario-fisico').on('input', function() {
            const itemId = $(this).data('item-id');
            const existenciaSistema = parseFloat($(this).closest('tr').find('td:eq(5)').text().replace(',', ''));
            const inventarioFisico = parseFloat($(this).val()) || 0;
            const diferencia = inventarioFisico - existenciaSistema;

            $(this).closest('tr').find('.diferencia').text(diferencia.toFixed(2));
        });
    });

    function imprimirFormato() {
        window.print();
    }

    function guardarInventario() {
        const inventarioData = [];

        $('.inventario-fisico').each(function() {
            const itemId = $(this).data('item-id');
            const inventarioFisico = $(this).val();
            const observaciones = $(this).closest('tr').find('.observaciones').val();
            const verificacion = $(this).closest('tr').find('.verificacion').is(':checked');

            if (inventarioFisico || observaciones) {
                inventarioData.push({
                    item_id: itemId,
                    inventario_fisico: inventarioFisico,
                    observaciones: observaciones,
                    verificacion: verificacion
                });
            }
        });

        if (inventarioData.length > 0) {
            // Aquí se implementaría el guardado via AJAX
            alert('Función de guardado - Por implementar. Items a guardar: ' + inventarioData.length);
        } else {
            alert('No hay datos para guardar');
        }
    }

    function finalizarInventario() {
        alert('Función de finalización de inventario - Por implementar');
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

<style>
    @media print {
        .card-tools,
        .btn,
        .alert {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }

        .table {
            font-size: 12px;
        }

        .inventario-fisico,
        .observaciones,
        .verificacion {
            border: 1px solid #000 !important;
        }
    }
</style>
@endpush