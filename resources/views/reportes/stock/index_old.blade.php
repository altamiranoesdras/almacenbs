@extends('layouts.app')

@include('layouts.xtra_condensed_css')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina', "Reporte Existencias en bodega central")


@section('titulo_pagina')
    Reporte Existencias
@endsection

@section('content')


    <x-content-header titulo="Reporte de Existencias en Bodega Central">
        <a class="btn btn-outline-secondary round"
           href="{!! route('home') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'reportes.stock','method' => 'get']) !!}
                        <div class="row">


{{--                                <div class="col-sm-6 mb-1">--}}
{{--                                    {!! Form::label('bodega_id','Sede / Bodega:') !!}--}}
{{--                                    {!! Form::select('bodega_id', select(\App\Models\Bodega::class,'nombre','id'), $bodega_id ?? null, ['id'=>'bodegas','class' => 'form-control']) !!}--}}
{{--                                </div>--}}

                            <div class="col-sm-6 mb-1">
                                {!! Form::label('item_id','Insumo:') !!}
                                {!!
                                    Form::select(
                                        'item_id',
                                        select(\App\Models\Item::whereHas('stocks')->withoutAppends(),'text','id',null,null)
                                        , request()->item_id ?? null
                                        , ['id'=>'items','class' => 'form-control','multiple','style'=>'width: 100%']
                                    )
                                !!}
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('categoria_id','Categoria:') !!}
                                {!!
                                    Form::select(
                                        'categoria_id',
                                        select(\App\Models\ItemCategoria::class)
                                        , request()->categoria_id ?? null
                                        , ['id'=>'categoria_ids','class' => 'form-control','style'=>'width: 100%']
                                    )
                                !!}
                            </div>

                            <div class="col-sm-6 mb-1">
                                {!! Form::label('renglon','Renglón:') !!}
                                {!! Form::select('renglon', select(\App\Models\Renglon::class,'text','id','Ver Todos'), $renglon, ['id'=>'categorias','class' => 'form-control']) !!}
                            </div>

                            <div class="col-sm-6 mb-1 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stock" id="radio_stock1"
                                           value="con_stock" {{ $stock=='con_stock'  ? 'checked' : '' }}>
                                    <label class="form-check-label" for="radio_stock1">Con Stock</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stock" id="radio_stock2"
                                           value="sin_stock" {{ $stock=='sin_stock'  ? 'checked' : '' }}>
                                    <label class="form-check-label" for="radio_stock2">Sin Stock</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stock" id="radio_stock3"
                                           value="todos" {{ $stock=='todos'  ? 'checked' : '' }}>
                                    <label class="form-check-label" for="radio_stock3">todos</label>
                                </div>
                            </div>


                            <div class="col-sm-6 d-flex align-items-r">
                                {!! Form::label('Limpiar','&nbsp;') !!}
                                <div>
                                    <a href="{{route('reportes.stock')}}" class="btn btn-secondary"
                                    >
                                        <i class="fa fa-eraser"></i>
                                        Limpiar
                                    </a>
                                </div>
                                {!! Form::label('buscar','&nbsp;') !!}
                                <div>
                                    <button class="btn btn-success" id="buscar" type="submit" name="buscar"
                                            value="1">
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
                    <div class="col-12 ">

                        <div class="card card-primary card-outline">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="custom-tabs-four-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#custom-tabs-four-home" type="button" role="tab"
                                                aria-controls="custom-tabs-four-home" aria-selected="true">
                                            Desglosado
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="custom-tabs-four-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#custom-tabs-four-profile" type="button" role="tab"
                                                aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            Unificado
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-home"
                                         role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                        <!-- Contenido Desglosado -->
                                        <form action="{{route('reportes.stock.actualizar')}}" method="post">
                                            @csrf
                                            @method('patch')


                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-hover table-striped table-xtra-condensed"
                                                    id="tabla-desglosado">
                                                    <thead>
                                                    <tr class="text-sm">
                                                                                                        <th>id</th>
                                                        <th>Bodega</th>
                                                        <th>Articulo</th>
                                                        <th>Código Insumo</th>
                                                        <th>Código Presentación</th>
                                                        <th>Renglón</th>
                                                        <th>U/M</th>
                                                        <th>Unidad Solicita</th>
                                                        <th>Fecha Vence</th>
                                                        <th>Stock</th>
                                                        <th data-toggle="tooltip" title="Precio de Compra Unitario">
                                                            Precio C/U
                                                        </th>
                                                        <th data-toggle="tooltip" title="Sub Total Compras">
                                                            SubTotal
                                                        </th>
                                                        @can('Ver transacciones de stock')
                                                            <th>Transacciones</th>
                                                        @endcan
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @php
                                                        /**
                                                        * @var \App\Models\Stock[] $stocks
                                                         */
                                                    @endphp
                                                    @foreach($stocks as $det)
                                                        <tr class="text-sm  ">
                                                                                                                <td>{{$det->id}}</td>
                                                            <td>{{$det->bodega->nombre}}</td>
                                                            <td>{{$det->item->texto_principal}}</td>
                                                            <td>{{$det->item->codigo_insumo}}</td>
                                                            <td>{{$det->item->codigo_presentacion}}</td>
                                                            <td>{{$det->item->renglon->numero ?? ''}}</td>
                                                            <td>{{$det->item->unimed->nombre ?? ''}}</td>
                                                            <td>{{$det->rrhhUnidad->nombre ?? ''}}</td>
                                                            <td>
                                                                <!-- campo fecha vence -->
                                                                <input type="date"
                                                                       class="form-control form-control-sm"
                                                                       name="fechas_vence[{{$det->id}}]"
                                                                       value="{{fechaIngles($det->fecha_vence)}}">

                                                            </td>
                                                            <td>{{nf($det->cantidad,0)}}</td>
                                                            <td>{{ dvs().nfp($det->precio_compra)}}</td>
                                                            <td>{{ dvs().nfp($det->sub_total)}}</td>
                                                            @can('Ver transacciones de stock')
                                                                <td>
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-outline-info btn-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#modalTransaciones{{$det->id}}">
                                                                        <i class="fa fa-list"></i>
                                                                        Trx
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="modalTransaciones{{$det->id}}" tabindex="-1" aria-labelledby="modelTitleId{{$det->id}}" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                                            <div class="modal-content shadow rounded-3">

                                                                                <!-- Header -->
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="modelTitleId">Transacciones de Stock</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                                </div>

                                                                                <!-- Body -->
                                                                                <div class="modal-body">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-bordered table-hover table-striped align-middle">
                                                                                            <thead class="table-light">
                                                                                            <tr class="text-sm">
                                                                                                <th>No</th>
                                                                                                <th>ID</th>
                                                                                                <th>Tipo</th>
                                                                                                <th>Cantidad</th>
                                                                                                <th>Precio</th>
                                                                                                <th>Referencia</th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                            @foreach($det->transcciones as $i => $trx)
                                                                                                <tr class="text-sm">
                                                                                                    <td>{{ $i+1 }}</td>
                                                                                                    <td>{{ $trx->id }}</td>
                                                                                                    <td>{{ $trx->tipo }}</td>
                                                                                                    <td>{{ nf($trx->cantidad,0) }}</td>
                                                                                                    <td>{{ dvs().nfp($trx->stock->precio_compra) }}</td>
                                                                                                    <td>{{ $trx->referencia }}</td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                            </tbody>
                                                                                            <tfoot>
                                                                                            <tr class="text-sm">
                                                                                                <th colspan="3">Total</th>
                                                                                                <th>{{ nf($det->transcciones->sum('cantidad'),0) }}</th>
                                                                                                <th>{{ dvs().nfp($det->transcciones->sum('stock.precio_compra')) }}</th>
                                                                                                <th colspan="1"></th>
                                                                                            </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Footer -->
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                                        Cerrar
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-primary">
                                                                                        Guardar
                                                                                    </button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="text-sm">
                                                        <th colspan="9">Total</th>

                                                        <th>{{nf($stocks->sum('cantidad'))}}</th>
                                                        <th></th>
                                                        <th>{{ dvs().nfp($stocks->sum('sub_total'))}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <div class="row">

                                                <!-- Boton Cancelar -->
                                                <div class="col-sm-6 mb-1 text-left">
                                                    <a href="{{route('reportes.stock')}}" class="btn btn-secondary">
                                                        <i class="fa fa-times"></i> Cancelar
                                                    </a>
                                                </div>

                                                <!-- Boton Guardar -->
                                                <div class="col-sm-6 mb-1 text-right">
                                                    <button class="btn btn-success" type="submit">
                                                        <i class="fa fa-save"></i> Guardar
                                                    </button>
                                                </div>
                                            </div>


                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-four-profile"
                                         role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                        <!-- Contenido Unificado -->
                                        <table
                                            class="table table-bordered table-hover table-striped table-xtra-condensed"
                                            id="tabla-unificado">
                                            <thead>
                                            <tr class="text-sm">
                                                <th>id</th>
                                                <th>Bodega</th>
                                                <th>Articulo</th>
                                                <th>Código Insumo</th>
                                                <th>Código Presentación</th>
                                                <th>Renglón</th>
                                                <th>U/M</th>
                                                <th>Stock</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $bodega= \App\Models\Bodega::find(request()->bodega_id ?? \App\Models\Bodega::PRINCIPAL)->nombre
                                            @endphp

                                            @foreach($items ?? [] as $det)
                                                <tr class="text-sm  ">
                                                    <td>{{$det->id}}</td>
                                                    <td>{{ $bodega }}</td>
                                                    <td>{{$det->texto_principal}}</td>
                                                    <td>{{$det->codigo_insumo}}</td>
                                                    <td>{{$det->codigo_presentacion}}</td>
                                                    <td>{{$det->renglon->numero ?? ''}}</td>
                                                    <td>{{$det->unimed->nombre ?? ''}}</td>
                                                    <td>
{{--                                                        @if(request()->bodega_id)--}}
                                                            {{nf($det->stock_bodega,0)}}
{{--                                                        @else--}}
{{--                                                            {{nf($det->stocks->sum('cantidad'),0)}}--}}
{{--                                                        @endif--}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr class="text-sm">
                                                <th>Total</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    @if(request()->bodega_id)
                                                        {{nf($items->sum('stock_bodega'),0)}}
                                                    @else
                                                        {{nf($items->sum(function ($item){ return $item->stocks->sum('cantidad'); }) )}}
                                                    @endif

                                                </th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    <!-- /.content -->
@endsection

@include('layouts.plugins.select2')

@push('scripts')

    <!--    Scripts reporte de stock datatable
------------------------------------------------->
    <script>
        $(function () {

            $("#items").select2({
                placeholder: 'Seleccione uno...',
                language: "es",
                maximumSelectionLength: 1,
                allowClear: true
            });

            $('#tabla-desglosado').DataTable({
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

            $('#tabla-unificado').DataTable({
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

        })
    </script>
@endpush


