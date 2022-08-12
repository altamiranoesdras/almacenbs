@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('title_page','Kardex por artículo')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Kardex por artículo</h1>
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
                            {!! Form::open(['route' => 'reportes.kardex','method' => 'get']) !!}
                            <div class="form-row">


                                <div class="form-group col-sm-6">
                                    {!! Form::label('item_id','Item:') !!}
                                    {!!
                                        Form::select(
                                            'item_id',
                                            select(\App\Models\Item::class,'text','id',null)
                                            , $item_id ?? null
                                            , ['id'=>'items','class' => 'form-control ','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                {{--<div class="form-group col-sm-3">--}}
                                {{--{!! Form::label('fecha','Fecha:') !!}--}}
                                {{--{!! Form::text('fecha', $fecha, ['class' => 'form-control','id' => 'fecha']) !!}--}}
                                {{--</div>--}}

                                <div class="form-group col-sm-6">
                                    {!! Form::label('boton','&nbsp;') !!}
                                    <div>
                                        <button type="submit" id="boton" class="btn btn-info" name="buscar" value="1">
                                            <i class="fa fa-search"></i> Consultar
                                        </button>
                                    </div>
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
                        @if($kardex )
                            <div class="card ">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        @foreach($kardex as  $folio => $datalles )

                                            <h2 class="float-right">
                                                Folio: <span class="text-danger">{{$folio}}</span>
                                            </h2>
                                            <table class="table table-bordered table-hover table-striped table-xtra-condensed dataTable">
                                            <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Proveedor o Solicitante</th>
                                                <th>Serie/Numero</th>
                                                <th>Ingresos</th>
                                                <th>Salidas</th>
                                                <th>Saldo</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            @foreach($datalles as  $det )

                                                <tr class="text-sm">
                                                    <td>{{fechaLtn($det->created_at)}}</td>
                                                    <td class="text-uppercase">{{$det->responsable}}</td>
                                                    <td>{{$det->codigo}}</td>
                                                    <td>{{$det->ingreso}}</td>
                                                    <td>{{$det->salida}}</td>
                                                    <td class="{{$loop->last ? 'text-bold' :''}}">{{$saldo+=$det->ingreso-=$det->salida}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @endforeach
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

            $("#fecha").datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: hoy
            });

            $('.dataTable').DataTable( {
                dom: 'Brtp',
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

            $("#items").select2({
                placeholder: 'Seleccione uno...',
                language: "es",
                maximumSelectionLength: 1,
                allowClear: true
            });

        })
    </script>
@endpush
