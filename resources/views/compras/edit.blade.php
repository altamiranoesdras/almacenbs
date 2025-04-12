@extends('layouts.app')

@section('titulo_pagina')
    Editar Compra
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Editar Compra
                    </h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('compras.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span
                            class="d-none d-sm-inline">Listado</span>
                    </a>
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

                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Ingreso</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('compras.actualizar.procesada',$compra->id)}}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.show_fields')
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                                </div>

                                <div class="col-sm-6">
                                    {!! Form::label('folio_almacen', 'Folio Libro Almacen:') !!}
                                    <a href="{!! route('compras.libro.almacen.pdf')."?mes={$compra->anio}-{$compra->mes}&buscar=1" !!}" target="_blank">
                                        Ver
                                    </a>
                                    {!! Form::text('folio_almacen', $compra->folio_almacen, ['class' => 'form-control']) !!}
                                </div>


                                <div class="col-sm-6">
                                    {!! Form::label('folio_inventario', 'Folio Inventario:') !!}
                                    {!! Form::text('folio_inventario', $compra->folio_inventario, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group col-sm-12" style="padding: 0px; margin: 0px"></div>
                                <br>
                                <div class=" col-sm-6 text-left">

                                    <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary mr-2">Regresar</a>

                                    @can('Anular ingreso de compra')
                                        @if($compra->puedeAnular() )
                                            <a href="#" onclick="deleteItemDt(this)" data-id="{{$compra->id}}"
                                               data-toggle="tooltip" title="Anular Ingreso"
                                               class='btn btn-outline-danger'>
                                                Anular Ingreso <i class="fa fa-undo-alt"></i>
                                            </a>

                                        @endif

                                    @endcan

                                    @if($compra->puedeCancelar() )
                                        {{--<a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-danger btn-xs'>--}}
                                        {{--<i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Solicitud de Compra"></i>--}}
                                        {{--</a>--}}
                                        <span data-toggle="tooltip" title="Cancelar Solicitud de Compra">
                                                <a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-outline-warning'>
                                                    Cancelar Solicitud de Compra <i class="fas fa-ban"></i>
                                                </a>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-sm-6 text-right">



                                    @if($compra->estado_id == \App\Models\CompraEstado::CREADA )
                                        <a href="{!! route('compra.ingreso',$compra->id) !!}" class="btn btn-outline-success">
                                            Ingresar
                                        </a>
                                    @endif

                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="fa fa-save "></i>
                                        Actualizar
                                    </button>
                                </div>


                            </div>
                            </form>



                            <form action="{{ route('compras.anular', $compra->id)}}"
                                  method="POST" id="delete-form{{$compra->id}}">
                                @method('POST')
                                @csrf
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">1H</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(!$compra->estaRecibida())
                                <h4 class="text-center text-info">
                                    El estado de la compra debe ser
                                    <span class="badge badge-info">
                                        {{\App\Models\CompraEstado::find(\App\Models\CompraEstado::RECIBIDA)->nombre}}
                                    </span>
                                    para poder generar 1H
                                </h4>
                            @else

                                @if(!$compra->tiene1h())

                                    <form action="{{route('compra.generar.1h',$compra->id)}}" method="post" class="esperar">

                                        @csrf
                                        <div class="form-row">


                                            <div class="form-group col-sm-4">
                                                {!! Form::label('folio', 'Folio:') !!}
                                                {!! Form::text('folio', null, ['class' => 'form-control','required']) !!}
                                            </div>

                                            <div class="form-group col-sm-8 ">
                                                <label for="generar">&nbsp;</label>
                                                <div>
                                                    <button type="submit" id="generar" class="btn btn-outline-primary" >
                                                        <i class="fa fa-gears"></i>
                                                        Generar 1H
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </form>

                                @else

                                    <form action="{{route('compra.actualiza.1h',$compra->id)}}" method="post">
                                        @csrf

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                            <h3>
                                                Folio:
                                                <span class="text-danger">
                                                {{$compra->compra1h->folio}}
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('compras.tabla_detalles_1h')
                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Observaciones:</label>
                                                <textarea class="form-control" name="observaciones" rows="2" cols="2">{{ $compra->compra1h->observaciones }}</textarea>
                                            </div>

                                            <!-- Submit Field -->
                                            <div class="form-group col-sm-12 text-right">
                                                <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary">
                                                    Regresar
                                                </a>


                                                <button type="submit" class="btn btn-outline-success">
                                                    Actualizar
                                                </button>

                                                <a href="{{route('compra.h1.pdf',$compra->id)}}" target="_blank"
                                                   class='btn btn-outline-primary' data-toggle="tooltip"
                                                   title="Imprimir 1H">
                                                    Imprimir 1H
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection


@push('scripts')
    <script >

        $(".esperarClick").on('click', function( event ) {

            Swal.fire({
                title: 'Espera por favor...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timerProgressBar: true,
            });

            Swal.showLoading();
        });

    </script>
@endpush

