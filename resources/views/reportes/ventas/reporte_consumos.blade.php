    @extends('layouts.app')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    Reporte - Consumos
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Reporte - Consumos</h1>
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
                            {!! Form::open(['route' => 'rpt.consumos.index','method' => 'get','autocomplete'=>"off"]) !!}
                            <div class="form-row">


                                <div class="form-group col-sm-2">
                                    {!! Form::label('del', 'Del:') !!}
                                    {!! Form::text('del', fecha($del), ['class' => 'form-control fecha']) !!}
                                </div>

                                <div class="form-group col-sm-2">
                                    {!! Form::label('al', 'Al:') !!}
                                    {!! Form::text('al', fecha($al) , ['class' => 'form-control fecha']) !!}
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
                        @if($consumos->count() > 0)
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tbl-dets">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>SubTotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($consumos as $consumo)
                                                <tr>
                                                    <td>{{$consumo->item->codigo}}</td>
                                                    <td>{{$consumo->item->nombre}}</td>
                                                    <td>{{$consumo->cantidad}}</td>
                                                    <td>{{$consumo->precio}}</td>
                                                    <td>{{ dvs().nfp($consumo->sub_total)}}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th >Total </th>
                                                <th ></th>
                                                <th ></th>
                                                <th>{{ nf($consumos->sum('cantidad')) }}</th>
                                                <th>{{ dvs().nfp($consumos->sum('sub_total')) }}</th>
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
