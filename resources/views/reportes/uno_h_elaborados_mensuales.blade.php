@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    1-H ELABORADOS MENSUALES
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">1-H ELABORADOS MENSUALES</h1>
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
                            {!! Form::open(['route' => 'reportes.1h.elaborados.mensuales', 'method' => 'get']) !!}
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
                                        <span class="info-box-icon bg-primary"><i class="fa fa-file-alt"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total 1-H</span>
                                            <span class="info-box-number">{{ $compras1h->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Utilizados</span>
                                            <span class="info-box-number">{{ $compras1h->where('del', 0)->where('al', 0)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-times"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Anulados</span>
                                            <span class="info-box-number">{{ $compras1h->where('del', '!=', 0)->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-dollar-sign"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Monto Total</span>
                                            <span class="info-box-number">Q.{{ number_format($compras1h->sum(function($compra1h) {
                                                return $compra1h->compra->total ?? 0;
                                            }), 2) }}</span>
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
                            <h3 class="card-title">Detalle de 1-H</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="tabla-reporte-1h-mensual">
                                    <thead>
                                        <tr>
                                            <th>ID 1-H</th>
                                            <th>Folio</th>
                                            <th>Fecha de Emisión</th>
                                            <th>Proveedor</th>
                                            <th>Estado</th>
                                            <th>Monto Total</th>
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($compras1h as $compra1h)
                                            <tr>
                                                <td>{{ $compra1h->id }}</td>
                                                <td>{{ $compra1h->folio }}</td>
                                                <td>{{ $compra1h->fecha_procesa->format('d/m/Y') }}</td>
                                                <td>{{ $compra1h->compra->proveedor->nombre ?? 'N/A' }}</td>
                                                <td>
                                                    @if($compra1h->del == 0 && $compra1h->al == 0)
                                                        <span >Utilizado</span>
                                                    @else
                                                        <span >Anulado</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">Q.{{ number_format($compra1h->compra->total ?? 0, 2) }}</td>
                                                <td>{{ $compra1h->observaciones ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info" title="Ver Detalle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
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
            $('#tabla-reporte-1h-mensual').DataTable({
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