@extends('layouts.app')

@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('titulo_pagina','Kardex por artículo')


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
    <div class="content-body">
        <div class="container-fluid">
            @include('adminlte-templates::common.errors')


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => 'reportes.kardex', 'method' => 'get']) !!}
                            <div class="row">


                                <div class="col-sm-10 mb-1">
                                    {!! Form::label('item_id', 'Item:') !!}
                                    {!! Form::select(
                                        'item_id',
                                        select(\App\Models\Item::whereHas('stocks'), 'text', 'id', null),
                                        $item->id ?? null,
                                        ['id' => 'items', 'class' => 'form-control ', 'multiple', 'style' => 'width: 100%'],
                                    ) !!}
                                </div>

                                {{-- <div class="col-sm-3 mb-1"> --}}
                                {{-- {!! Form::label('fecha','Fecha:') !!} --}}
                                {{-- {!! Form::text('fecha', $fecha, ['class' => 'form-control','id' => 'fecha']) !!} --}}
                                {{-- </div> --}}

                                <div class="col-sm-2 mb-1">
                                    {!! Form::label('boton', '&nbsp;') !!}
                                    <div>
                                        <button type="submit" id="boton" class="btn btn-info" name="buscar"
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

            <div class="row" id="resultadoKardex">
                <div class="col">

                    @if (isset($buscar))
                        @php
                            $totalIngreso = 0;
                            $totalEgreso = 0;

                        @endphp
                        @if ($kardex->count() > 0)

                            <div class="card ">
                                <div class="card-body">
                                    <h3 class="text-info">
                                        {{ $item->text }}
                                    </h3>

                                    @foreach ($kardex as $folio => $datalles)
                                        @php
                                            $codigo_insumo = $datalles->first()->codigo_insumo;
                                            $del = $datalles->first()->del;
                                            $al = $datalles->first()->al;
                                            $folioSigiente = $datalles->first()->folio_siguiente;
                                            $ultimoDetalle = $datalles->last();
                                        @endphp

                                        <form action="{{ route('reportes.kardex.actualizar', $folio) }}"
                                            @submit.prevent="actualizaKardex({{ $folio }})"
                                            id="form{{ $folio }}" method="post">
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
                                                <div class="col-sm-6 pt-3 pb-0 text-right">

                                                    <h3 class="mt-3">
                                                        Folio: <span class="text-danger">{{ $folio }}</span>
                                                    </h3>
                                                </div>
                                            </div>

                                            <div class="table-responsive mt-1">
                                                <table
                                                    class="table table-bordered table-hover table-striped table-xtra-condensed ">
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
                                                    <tbody id="sortable{{ $folio }}" class="connectedSortable"
                                                        data-folio="{{ $folio }}">


                                                        @foreach ($datalles as $det)
                                                            <tr class="text-sm text-right" id="{{ $det->id }}">
                                                                <td>{{ $det->fecha_ordena }}</td>
                                                                <td class="text-uppercase">
                                                                    {{ $det->ingreso ? $det->codigo : '' }}</td>
                                                                <td class="text-uppercase ">
                                                                    @if ($det->salida)
                                                                        {{-- {!! Form::text("codigos_salidas[$det->id]", $det->codigo, ['class' => 'form-control form-control-sm']) !!} --}}
                                                                        <span> {{ $det->codigo }} </span>

                                                                    @endif
                                                                </td>
                                                                <td class="text-uppercase">{{ $det->responsable }}</td>

                                                                <td>{{ $det->ingreso }}</td>
                                                                {{--                                                            <td>{{$det->ingreso ? nfp($det->precio) : ''}}</td> --}}
                                                                <td>
                                                                    @if ($det->ingreso)
                                                                        {{-- {!! Form::text("precios_movimiento[$det->id]", $det->precio, ['class' => 'form-control form-control-sm']) !!} --}}
                                                                        <span>{{ $det->precio }}</span>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $det->ingreso ? nfp($det->precio * $det->ingreso, 2) : '' }}
                                                                </td>

                                                                <td>{{ $det->salida }}</td>
                                                                {{--                                                            <td>{{$det->salida ? nfp($det->precio) : $det->salida}}</td> --}}
                                                                <td>
                                                                    @if ($det->salida)
                                                                        {{-- {!! Form::text("precios_movimiento[$det->id]", $det->precio, ['class' => 'form-control form-control-sm']) !!} --}}
                                                                        <span>{{ $det->precio }}</span>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $det->salida ? nfp($det->precio * $det->salida, 2) : '' }}
                                                                </td>

                                                                @php
                                                                    $saldo += $det->ingreso -= $det->salida;
                                                                    $totalIngreso += $det->precio * $det->ingreso;
                                                                    $totalEgreso += $det->precio * $det->salida;
                                                                    $saldoStock =
                                                                        $det->saldo_stock == 0
                                                                            ? $saldo
                                                                            : $det->saldo_stock;
                                                                    $subTotalStock =
                                                                        ($det->saldo ?? $saldoStock) *
                                                                        ($det->precio_existencia ?? $det->precio);
                                                                @endphp

                                                                <td class="text-bold">
                                                                    {{-- {!! Form::text("saldos[$det->id]", $det->saldo ?? $saldoStock, ['class' => 'form-control form-control-sm']) !!} --}}
                                                                    <span>{{ $det->saldo ?? $saldoStock }}</span>

                                                                </td>

                                                                <td>
                                                                    {{-- {!! Form::text("precios_existencia[$det->id]", $det->precio_existencia ?? $det->precio, ['class' => 'form-control form-control-sm',]) !!} --}}
                                                                    <span>{{ $det->precio_existencia ?? $det->precio }}</span>
                                                                </td>
                                                                <td>
                                                                    {{--                                                                {{nfp($det->precio * $saldo,2)}} --}}
                                                                    {{--                                                                <br> --}}
                                                                    {{--                                                                IN: {{$totalIngreso}} --}}
                                                                    {{--                                                                <br> --}}
                                                                    {{--                                                                EG: {{$totalEgreso}} --}}
                                                                    {{--                                                                <br> --}}
                                                                    {{--                                                                @php --}}
                                                                    {{-- //                                                                $total = $totalIngreso > 0 ? $totalIngreso-$totalEgreso : $totalEgreso; --}}
                                                                    {{--                                                                $total = $saldo * ($det->precio_existencia ?? $det->precio); --}}
                                                                    {{--                                                                @endphp --}}
                                                                    {{--                                                                {{nfp($total,2)}} --}}
                                                                    {{ nfp($subTotalStock) }}
                                                                </td>
                                                                <td>
                                                                    <input type="hidden"
                                                                        name="impresos[{{ $det->id }}]"
                                                                        value="0">
                                                                    <input type="checkbox"
                                                                        name="impresos[{{ $det->id }}]" value="1"
                                                                        {{ $det->impreso ? 'checked' : '' }}>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        @if ($loop->last)
                                                            <tr class="text-sm text-center">
                                                                <td colspan="20">
                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-sm btn-info"
                                                                        data-toggle="modal" data-target="#exampleModal">
                                                                        <i class="fa fa-arrow-down"></i>
                                                                        Pasar ultimo movimiento a nuevo folio
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade text-left" id="exampleModal"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">Confirmar
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p> si esta seguro de pasar a un nuevo
                                                                                        folio, presione el boton "Sí, Pasar
                                                                                        a nuevo folio"</p>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Cancelar</button>
                                                                                    <a href="{{ route('reportes.kardex.nuevo.folio', $ultimoDetalle->id) }}"
                                                                                        class="btn btn-sm btn-success"
                                                                                        onclick="esperar()">
                                                                                        Sí, Pasar a nuevo folio
                                                                                    </a>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">

                                                <div class="col-sm-10">

                                                </div>
                                                <div class="col-sm-2 pt-3 pb-0 text-right">

                                                    {!! Form::label('folio_siguiente', 'SALDOS PASAN A TARJETA:') !!}
                                                    {!! Form::text('folio_siguiente', $folioSigiente, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="col-sm-12 text-right mt-3">

                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-success mr-3">
                                                        <i class="fa fa-save"></i>
                                                        Actualizar
                                                    </button>

                                                    <button type="button" class="btn btn-primary"
                                                        @click.prevente="imprimirFolio({{ $folio }})">
                                                        <i class="fa fa-print"></i>
                                                        Imprimir
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
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
        new Vue({
            el: '#resultadoKardex',
            name: 'resultadoKardex',
            mounted() {},
            created() {},
            data: {},
            methods: {
                async actualizaKardex(folio) {

                    esperar();

                    try {

                        let datos = $('#form' + folio).serialize();

                        let response = await axios.post(route('reportes.kardex.actualizar.ajax', folio), datos);

                        iziTs(response.data.message);

                    } catch (e) {
                        notifyErrorApi(e)
                    }

                    finEspera();
                },
                async imprimirFolio(folio) {

                    await this.actualizaKardex(folio);

                    let ruta = route('reportes.kardex.pdf', folio) + "?item={{ $item->id ?? '' }}";

                    //abre en nueva ventana
                    window.open(ruta, '_blank');

                }
            }
        });

        $(function() {

            var hoy = new Date();

            //        var manana=new Date(hoy.getTime() + 24*60*60*1000);

            // $("#fecha").datetimepicker({
            //     format: 'DD/MM/YYYY',
            //     defaultDate: hoy
            // });

            $('.dataTable').DataTable({
                dom: 'Brtip',
                paginate: false,
                ordering: false,
                language: {
                    "url": "{{ asset('js/SpanishDataTables.json') }}"
                },
                buttons: [{
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
                    // {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
                ],
                "order": []
            });

            $("#items").select2({
                placeholder: 'Seleccione uno...',
                language: "es",
                maximumSelectionLength: 1,
                allowClear: true
            });

            @if (isset($buscar) && $kardex->count() > 0)

                let elementosSortables = @json(
                    $kardex->keys()->map(function ($item) {
                            return '#sortable' . $item;
                        })->implode(','));


                $(elementosSortables).sortable({
                    connectWith: ".connectedSortable",
                    update: async function(event, ui) {

                        let folioOrigen = $(this).data('folio');
                        let folioDestino = ui.item.parent().data('folio');

                        if (folioOrigen != folioDestino) {

                            let id = ui.item.attr('id');

                            console.log(id, folioOrigen, folioDestino);

                            try {
                                let response = await actualizarOrden(folioOrigen, folioDestino, id);

                                iziTs(response.data.message);

                            } catch (e) {

                                notifyErrorApi(e)

                            }

                        }

                    }
                }).disableSelection();

                async function actualizarOrden(folioOrigen, folioDestino, id) {
                    let data = {
                        folioOrigen,
                        folioDestino,
                        id
                    };
                    let response = await axios.post(route('api.kardexes.ordenar_filas'), data);

                    return response;
                }
            @endif


        })
    </script>
@endpush
