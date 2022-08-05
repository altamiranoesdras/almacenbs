@extends('layouts.app')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    Reporte de Ganancias
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Reporte de Ganancias</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            @include('adminlte-templates::common.errors')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'rpt.ventas.cats.res','method' => 'get','autocomplete'=>"off"]) !!}
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        {!! Form::label('del', 'Del:') !!}
                                        {!! Form::date('del', $del , ['class' => 'form-control fecha']) !!}
                                    </div>

                                    <div class="form-group col-sm-4">
                                        {!! Form::label('al', 'Al:') !!}
                                        {!! Form::date('al', $al , ['class' => 'form-control fecha']) !!}
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <br>
                                        <button class="btn btn-success" type="submit" name="buscar"  value="1">
                                            <i class="fa fa-search"></i> Consultar
                                        </button>
                                    </div>

                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col">
                    @if($detalles )
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tbl-dets">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Venta</th>
                                            <th>Costo</th>
                                            <th>Ganancia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($detalles as $det)
                                            <tr>
                                                <td>{{$det->nombre}}</td>
                                                <td>{{nf($det->cantidad)}}</td>
                                                <td>{{ dvs().' '.nfp($det->total_ventas)}}</td>
                                                <td>{{ dvs().' '.nfp($det->total_costo)}}</td>
                                                <td>{{ dvs().' '.nfp($det->utilidad)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th >Total </th>
                                            <th>{{ nf($detalles->sum('cantidad') ) }}</th>
                                            <th>{{ dvs().' '.nfp($detalles->sum('total_ventas') ) }}</th>
                                            <th>{{ dvs().' '.nfp($detalles->sum('total_costo') ) }}</th>
                                            <th>{{ dvs().' '.nfp($detalles->sum('utilidad') ) }}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>No hay resultados para su busqueda</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('scripts')
<!--    Scripts fields clientes
------------------------------------------------->
<script>
    $(function () {


        $('#tbl-dets').DataTable( {
            dom: 'Brtip',
            paginate: false,
            ordering: false,
            language: {
                "url": "{{asset('js/SpanishDataTables.json')}}"
            },
            buttons: [
                {extend : 'copy', 'text' : '<i class="fa fa-copy"></i> <span class="d-none d-sm-inline">Copiar</span>'},
                {extend : 'csv', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">CSV</span>'},
                {extend : 'excel', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">Excel</span>'},
                {extend : 'pdf', 'text' : '<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>'},
                {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
            ],
            "order": []
        } );

    })
</script>
@endpush

