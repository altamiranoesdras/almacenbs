@extends('layouts.app')

@section('titulo_pagina', 'Editar Compra')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Editar Compra
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
                       href="{{ route('compras.index') }}">
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ingreso</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i data-feather="chevron-up"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{route('compras.actualizar.procesada',$compra->id)}}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        @include('compras.show_fields')
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        {!! Form::label('folio_almacen', 'Folio Libro Almacen:') !!}
                                        <a href="{!! route('compras.libro.almacen.pdf')."?mes={$compra->anio}-{$compra->mes}&buscar=1" !!}" target="_blank">
                                            Ver
                                        </a>
                                        {!! Form::text('folio_almacen', $compra->folio_almacen, ['class' => 'form-control']) !!}
                                    </div> --}}


                                    {{-- <div class="col-sm-6">
                                        {!! Form::label('folio_inventario', 'Folio Inventario:') !!}
                                        {!! Form::text('folio_inventario', $compra->folio_inventario, ['class' => 'form-control']) !!}
                                    </div> --}}

                                    <div class="col-sm-12 mb-1" style="padding: 0px; margin: 0px"></div>
                                    <br>
                                    <div class=" col-sm-6 text-left">

                                        <a href="{!! route('compras.index') !!}" class="btn round btn-outline-secondary mr-2">Regresar</a>

                                        @can('Anular Ingreso de almacen')
                                            @if($compra->puedeAnular() )
                                                <a href="#" onclick="deleteItemDt(this)" data-id="{{$compra->id}}"
                                                   data-toggle="tooltip" title="Anular Ingreso"
                                                   class='btn round btn-outline-danger ms-1'>
                                                    Anular Ingreso
                                                    <i class="fa fa-undo-alt"></i>
                                                </a>

                                            @endif

                                        @endcan

                                        @if($compra->puedeCancelar() )
                                            {{--<a href="#modal-delete-{{$compra->id}}" data-bs-toggle="modal" class='btn btn-icon btn-flat-danger rounded-circle'>--}}
                                            {{--<i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Solicitud de Compra"></i>--}}
                                            {{--</a>--}}
                                            <span data-toggle="tooltip" title="Cancelar Solicitud de Compra">
                                                <a href="#modal-delete-{{$compra->id}}" data-bs-toggle="modal" class='btn btn-outline-warning'>
                                                    Cancelar Solicitud de Compra <i class="fas fa-ban"></i>
                                                </a>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-sm-6 text-right">



                                        @if($compra->estado_id == \App\Models\CompraEstado::CREADA )
                                            <a href="{!! route('compra.ingreso',$compra->id) !!}" class="btn btn-outline-success round ms-1">
                                                Ingresar
                                            </a>
                                        @endif

                                        <button type="submit" class="btn btn-outline-success round float-end">
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
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">1H</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @if(!$compra->estaRecibida())
                                <h4 class="text-center text-info">
                                    El estado de la compra debe ser
                                    <span class="badge badge-dark">
                                            {{\App\Models\CompraEstado::find(\App\Models\CompraEstado::RECIBIDA)->nombre}}
                                        </span>
                                    para poder generar 1H
                                </h4>
                            @else

                                @if(!$compra->tiene1h())

                                    <form action="{{route('compra.generar.1h',$compra->id)}}" method="post" class="esperar">

                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-4 mb-1">
                                                {!! Form::label('folio', 'Folio:') !!}
                                                {!! Form::text('folio', null, ['class' => 'form-control','required']) !!}
                                            </div>

                                            <div class="col-sm-8 mb-1 ">
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
                                        <div class="row">

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                                <h3>
                                                    Folio:
                                                    <span class="text-danger">
                                                    {{$compra->compra1h->folio}}
                                                    </span>
                                                </h3>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-1">
                                                @include('compras.tabla_detalles_1h')
                                            </div>


                                            <div class="form-group col-md-12 mb-1">
                                                <label>Observaciones:</label>
                                                <textarea class="form-control" name="observaciones" rows="2" cols="2">{{ $compra->compra1h->observaciones }}</textarea>
                                            </div>

                                            <!-- Submit Field -->
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 ">
                                                <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary round me-1">
                                                    Regresar
                                                </a>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 mb-1 text-center">
                                                <button type="submit" class="btn btn-outline-success round">
                                                    Actualizar
                                                </button>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 float-end">

                                                <a href="{{route('compra.h1.pdf',$compra->id)}}" target="_blank"
                                                   class='btn btn-outline-primary round float-end' data-toggle="tooltip"
                                                   title="Imprimir 1H">
                                                    Imprimir 1H
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col-md-6 -->
        </div>

    </div>

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

