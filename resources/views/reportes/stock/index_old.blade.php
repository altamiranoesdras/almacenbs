@extends('layouts.app')

@include('layouts.xtra_condensed_css')
@include('layouts.plugins.datatables_reportes')


@section('htmlheader_title')
    Reporte Stock
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Reporte Stock</h1>
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
                            {!! Form::open(['route' => 'reportes.stock','method' => 'get']) !!}
                            <div class="form-row">


                                <div class="form-group col-sm-6">
                                    {!! Form::label('bodega_id','Sede / Bodega:') !!}
                                    {!! Form::select('bodega_id', select(\App\Models\Bodega::class,'nombre','id'), $bodega_id ?? null, ['id'=>'bodegas','class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-6">
                                    {!! Form::label('renglon','Renglón:') !!}
                                    {!! Form::select('renglon', select(\App\Models\Renglon::class,'text','id','Ver Todos'), $renglon, ['id'=>'categorias','class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-2 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock1" value="con_stock" {{ $stock=='con_stock'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock1">Con Stock</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock2" value="sin_stock" {{ $stock=='sin_stock'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock2" >Sin Stock</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stock" id="radio_stock3" value="todos" {{ $stock=='todos'  ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio_stock3">todos</label>
                                    </div>
                                </div>


                                <div class="form-group col-sm-2 ">
                                    {!! Form::label('buscar','&nbsp;') !!}
                                    <div>
                                        <button class="btn btn-success" id="buscar" type="submit" name="buscar"  value="1">
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


            <!-- /.row -->
            @if(isset($buscar))
                @if($stocks )
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tbl-dets">
                                            <thead>
                                            <tr class="text-sm">
                                                <th>id</th>
                                                <th>Articulo</th>
                                                <th>Código Insumo</th>
                                                <th>Código Presentación</th>
                                                <th>Renglón</th>
                                                <th>U/M</th>
                                                <th>Fecha Vence</th>
                                                <th>Stock</th>
                                                <th data-toggle="tooltip" title="Precio de Compra Unitario">
                                                    Precio C/U
                                                </th>
                                                <th data-toggle="tooltip" title="Sub Total Compras">
                                                    SubTotal
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($stocks as $det)
                                                <tr class="text-sm  ">
                                                    <td>{{$det->id}}</td>
                                                    <td>{{$det->item->nombre}}</td>
                                                    <td>{{$det->item->codigo_insumo}}</td>
                                                    <td>{{$det->item->codigo_presentacion}}</td>
                                                    <td>{{$det->item->renglon->numero}}</td>
                                                    <td>{{$det->item->unimed->nombre}}</td>
                                                    <td>{{fechaLtn($det->fecha_vence)}}</td>
                                                    <td>{{nf($det->cantidad)}}</td>
                                                    <td>{{ dvs().nfp($det->precio_compra)}}</td>
                                                    <td>{{ dvs().nfp($det->sub_total)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-sm">
                                                    <th >Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>{{nf($stocks->sum('cantidad'))}}</th>
                                                    <th></th>
                                                    <th>{{ dvs().nfp($stocks->sum('sub_total'))}}</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                @else
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>No hay resultados para su busqueda</strong>
                    </div>
                @endif
            @endif
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@push('scripts')

<!--    Scripts reporte de stock datatable
------------------------------------------------->
<script>
    $(function () {

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
