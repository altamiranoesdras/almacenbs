@extends('layouts.app')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    Reporte - Ventas por categoria
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Reporte - Ventas por categoria</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'rpt.ventas.cats','method' => 'get','autocomplete'=>"off"]) !!}
                            <div class="form-row">

                                <div class="form-group col-sm-5">
                                    {!! Form::label('icategoria_id','Categoría:') !!}
                                    {!! Form::select('icategoria_id', $cats, $cat, ['id'=>'icategorias','class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-2">
                                    {!! Form::label('del', 'Del:') !!}
                                    {!! Form::text('del', isset($del) ? fecha($del) : hoy(), ['class' => 'form-control fecha']) !!}
                                </div>

                                <div class="form-group col-sm-2">
                                    {!! Form::label('al', 'Al:') !!}
                                    {!! Form::text('al', isset($al) ? fecha($al) : hoy(), ['class' => 'form-control fecha']) !!}
                                </div>

                                <div class="form-group col-sm-2">
                                    <button class="btn btn-success" type="submit" name="buscar"  value="1" style="margin-top: 23px">
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
                    @if(isset($buscar))
                        @if($detalles )
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tbl-dets">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>SubTotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($detalles as $det)
                                                <tr>
                                                    <td>{{$det->item->codigo}}</td>
{{--                                                    <td>{{$det->codigo}}</td>--}}
                                                    <td>{{$det->item->nombre}}</td>
                                                    <td>{{$det->cantidad}}</td>
                                                    <td>{{ dvs().nfp($det->sub)}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfooter>
                                                <tr>
                                                    <th >Total </th>
                                                    <th ></th>
                                                    <th>{{nf($detalles->sum('cantidad'))}}</th>
                                                    <th>{{ dvs().nfp($detalles->sum('sub')) }}</th>
                                                </tr>
                                            </tfooter>
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

        var hoy=new Date();

//        var manana=new Date(hoy.getTime() + 24*60*60*1000);

        $(".fecha").datetimepicker({
            format: 'DD/MM/YYYY',
//            defaultDate: hoy
        });

        $('#tbl-dets').DataTable( {
            dom: 'Brtip',
            paginate: false,
            ordering: true,
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
