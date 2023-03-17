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


                                <div class="form-group col-sm-10">
                                    {!! Form::label('item_id','Item:') !!}
                                    {!!
                                        Form::select(
                                            'item_id',
                                            select(\App\Models\Item::whereHas('stocks'),'text','id',null)
                                            , $item->id ?? null
                                            , ['id'=>'items','class' => 'form-control ','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                {{--<div class="form-group col-sm-3">--}}
                                {{--{!! Form::label('fecha','Fecha:') !!}--}}
                                {{--{!! Form::text('fecha', $fecha, ['class' => 'form-control','id' => 'fecha']) !!}--}}
                                {{--</div>--}}

                                <div class="form-group col-sm-2">
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
                        @if($kardex->count() > 0)

                            <div class="card ">
                                <div class="card-body">
                                    <h3 class="text-info">
                                        {{$item->text}}
                                    </h3>

                                        @foreach($kardex as  $folio => $datalles )
                                            @php
                                                $codigo_insumo = $datalles->first()->codigo_insumo;
                                                $del = $datalles->first()->del;
                                                $al = $datalles->first()->al;
                                            @endphp

                                        <form action="{{route('reportes.kardex.actualizar',$folio)}}" method="post">
                                            @csrf
                                            @method('PATCH')

                                            <div class="row  mp-1">
                                                <div class="col-sm-6">

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            {!! Form::label('codigo_insumo', 'Código:') !!}
                                                            {!! Form::text('codigo_insumo', $codigo_insumo, ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="col-sm-4">
                                                            {!! Form::label('del', 'Del:') !!}
                                                            {!! Form::date('del', $del, ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="col-sm-4">
                                                            {!! Form::label('al', 'Al:') !!}
                                                            {!! Form::date('al', $al, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 pt-3 pb-0 text-right" >

                                                    <h3 class="mt-3">
                                                        Folio: <span class="text-danger">{{$folio}}</span>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="table-responsive mt-1">
                                                <table class="table table-bordered table-hover table-striped table-xtra-condensed ">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th rowspan="2">Fecha</th>
                                                        <th colspan="2">DOCUMENTO NO.</th>
                                                        <th rowspan="2">Nombre Solicitante</th>
                                                        <th colspan="3">Entradas</th>
                                                        <th colspan="3">Salidas</th>
                                                        <th colspan="3">Existencias</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <th>Forma 1H</th>
                                                        <th>Requisición</th>
                                                        <th>Cantidad</th>
                                                        <th>P.U.</th>
                                                        <th>Valor Total</th>
                                                        <th>Cantidad</th>
                                                        <th>P.U.</th>
                                                        <th>Valor Total</th>
                                                        <th>Cantidad</th>
                                                        <th>P.U.</th>
                                                        <th>Valor Total</th>
                                                        <th>
                                                            <i class="fa fa-print"></i>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($datalles as  $det )

                                                        <tr class="text-sm text-right">
                                                            <td>{{fechaLtn($det->created_at)}}</td>
                                                            <td class="text-uppercase">{{$det->ingreso ? $det->codigo : ''}}</td>
                                                            <td class="text-uppercase ">
                                                                @if($det->salida)
                                                                    {!! Form::text("codigos_salidas[$det->id]", $det->codigo, ['class' => 'form-control form-control-sm']) !!}
                                                                @endif
                                                            </td>
                                                            <td class="text-uppercase">{{$det->responsable}}</td>
                                                            <td>{{$det->ingreso}}</td>
                                                            <td>{{$det->ingreso ? nfp($det->precio) : ''}}</td>
                                                            <td>{{$det->ingreso ? nfp($det->precio * $det->ingreso,2) : ''}}</td>
                                                            <td>{{$det->salida}}</td>
                                                            <td>{{$det->salida ? nfp($det->precio) : $det->salida}}</td>
                                                            <td>{{$det->salida ? nfp($det->precio * $det->salida,2) : ''}}</td>

                                                            @php
                                                                $saldo+=$det->ingreso-=$det->salida
                                                            @endphp
                                                            <td class="{{$loop->last ? 'text-bold' :''}}">
                                                                {{$saldo}}
                                                            </td>
                                                            <td>{{nfp($det->precio)}}</td>
                                                            <td>{{nfp($det->precio * $saldo,2)}}</td>
                                                            <td>
                                                                <input type="hidden" name="impresos[{{$det->id}}]" value="0">
                                                                <input type="checkbox" name="impresos[{{$det->id}}]" value="1" {{$det->impreso ? 'checked' : ''}}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 text-right">

                                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-success mr-3">
                                                        <i class="fa fa-save"></i>
                                                        Actualizar
                                                    </button>

                                                    <a href="{{route('reportes.kardex.pdf',$folio)}}" target="_blank" class="btn btn-primary">
                                                        <i class="fa fa-print"></i>
                                                        Imprimir
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        @endforeach
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>No hay resultados para su búsqueda</strong>
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
                    // {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
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
