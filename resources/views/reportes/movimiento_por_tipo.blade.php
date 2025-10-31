@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    REPORTE DE MOVIMIENTO POR TIPO
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">REPORTE DE MOVIMIENTO POR TIPO</h1>
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
                            {!! Form::open(['route' => 'reportes.movimiento.por.tipo', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('tipo_movimiento', 'Tipo de Movimiento') !!}
                                        {!! Form::select('tipo_movimiento', [
                                            'ingreso' => 'Ingreso',
                                            'salida' => 'Salida',
                                            '' => 'Todos'
                                        ], $tipo_movimiento, ['class' => 'form-control select2']) !!}
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
                                <div class="col-md-3">
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
                            <h3 class="card-title">Resumen de Movimientos</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-arrow-up"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Ingresos</span>
                                            <span class="info-box-number">{{ $movimientos->where('tipo', 'ingreso')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i class="fa fa-arrow-down"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Salidas</span>
                                            <span class="info-box-number">{{ $movimientos->where('tipo', 'salida')->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-exchange"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Movimientos</span>
                                            <span class="info-box-number">{{ $movimientos->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-chart-bar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Cantidad Total</span>
                                            <span class="info-box-number">{{ number_format($movimientos->sum('cantidad'), 2) }}</span>
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="tabla-reporte-tipo">
                                    <thead>
                                        <tr>
                                            <th>ID Operación</th>
                                            <th>Tipo</th>
                                            <th>Código Insumo</th>
                                            <th>Código Presentación</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Cantidad</th>
                                            <th>Fecha</th>
                                            <th>Responsable</th>
                                            <th>Folio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($movimientos as $movimiento)
                                            <tr>
                                                <td>{{ $movimiento->id }}</td>
                                                <td>
                                                    @if($movimiento->tipo === 'ingreso')
                                                        <span >INGRESO</span>
                                                    @else
                                                        <span >SALIDA</span>
                                                    @endif
                                                </td>
                                                <td>{{ $movimiento->item->codigo_insumo ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->codigo_presentacion ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->nombre ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($movimiento->cantidad, 2) }}</td>
                                                <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $movimiento->responsable ?? 'N/A' }}</td>
                                                <td>{{ $movimiento->folio ?? 'N/A' }}</td>
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
        new Vue({
                el: '#root',
                name: 'root',
                created() {

                },
                mounted() {
                    cargarDatatable();
                },
                data: {

                    

                },
                methods: {

                },
                computed:{

                },
                watch:{

                }
            });

        function cargarDatatable() {
            $('#tabla-reporte-tipo').DataTable({
                dom: 'Brtip',
                paginate: false,
                ordering: true,
                language: {
                    "url": "{{asset('js/SpanishDataTables.json')}}"
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
        }
    </script>
@endpush