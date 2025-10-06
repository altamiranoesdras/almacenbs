@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    EXISTENCIA POR UNIDAD SOLICITANTE
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">EXISTENCIA POR UNIDAD SOLICITANTE</h1>
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
                            {!! Form::open(['route' => 'reportes.existencia.unidad.solicitante', 'method' => 'get']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label for="tipos">Unidad Solicitante:</label>
                                        <multiselect v-model="unidades_seleccionadas" :options="rr_hh_unidades" label="text" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
                                        </multiselect>
                                        <input type="hidden" name="unidades_seleccionadas[]" v-for="unidad in unidades_seleccionadas" :value="unidad.id">
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
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
                                </div> --}}
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fa fa-search"></i> Filtrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-striped" id="tabla-reporte-existencia">
                                    <thead>
                                        <tr>
                                            <th>ID Insumo</th>
                                            <th>Unidad Solicitante</th>
                                            <th>Código Insumo</th>
                                            <th>Nombre Insumo</th>
                                            <th>Presentación</th>
                                            <th>Existencia</th>
                                            <th>Última Solicitud</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                            @php
                                                $unidades_solicitantes = $item->solicitudDetalles->pluck('solicitud.unidad.nombre')->unique();
                                                $ultima_solicitud = $item->solicitudDetalles->sortByDesc('created_at')->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $unidades_solicitantes->implode(', ') }}</td>
                                                <td>{{ $item->codigo_insumo }}</td>
                                                <td>{{ $item->nombre }}</td>
                                                <td>{{ $item->presentacion->nombre ?? 'N/A' }}</td>
                                                <td class="text-right">{{ number_format($item->stock_total, 2) }}</td>
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
    $('#tabla-reporte-existencia').DataTable({
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

    new Vue({
            el: '#root',
            name: 'root',
            created() {

            },
            data: {

                unidades_seleccionadas: @json(\App\Models\RrhhUnidad::whereIn('id', $unidades_seleccionadas)->get() ?? []),
                rr_hh_unidades: @json(\App\Models\RrhhUnidad::areas()->solicitan()->get() ?? []),

            },
            methods: {

            },
            computed:{

            },
            watch:{

            }
        });
</script>


@endpush