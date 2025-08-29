@extends('layouts.app')

@section('titulo_pagina', 'Editar Ingreso Almacén')

@section('content')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Editar Ingreso Almacén
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
                            <form action="{{route('compras.actualizar.procesada',$compra->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        @include('compras.show_fields')
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                                        @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        @if($compra->estado_id == \App\Models\CompraEstado::PROCESADO_PENDIENTE_RECIBIR )
                                            <a href="{!! route('compra.ingreso',$compra->id) !!}"
                                               class="btn btn-outline-success round ms-1">
                                                Ingresar
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-4 d-flex justify-content-center">
                                        <div type="submit" class="btn btn-outline-success round mx-auto">
                                            <i class="fa fa-save "></i>
                                            Actualizar
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{!! route('compras.index') !!}" class="btn round btn-outline-secondary mr-2 float-end">
                                            Regresar
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-12">
                                    @can('Anular Ingreso de almacen')
                                        @if($compra->puedeAnular() )

                                            <button  type="button"
                                                data-toggle="tooltip" title="Anular Ingreso"
                                                class="btn round btn-outline-danger ms-1 float-end"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-anular">
                                                Anular Ingreso <i class="fa fa-undo-alt"></i>
                                            </button>

                                            {{-- <div onclick="deleteItemDt(this)" data-id="{{$compra->id}}"
                                                data-toggle="tooltip" title="Anular Ingreso"
                                                class='btn round btn-outline-danger ms-1 float-end'>
                                                Anular Ingreso
                                                <i class="fa fa-undo-alt"></i>
                                            </div> --}}
                                        @endif
                                    @endcan
                                    @if( $compra->puedeCancelar() )
                                        <form action="{{ route('compras.anular', $compra->id)}}" method="POST" id="delete-form{{$compra->id}}">
                                            @method('POST')
                                            @csrf
                                            <button data-toggle="tooltip" title="Cancelar Solicitud de Compra" class='btn btn-outline-danger float-end' >
                                                Cancelar Solicitud de Compra <i class="fas fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
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
                                    <span class="">
                                            {{\App\Models\CompraEstado::find(\App\Models\CompraEstado::INGRESADO)->nombre}}
                                        </span>
                                    para poder generar 1H
                                </h4>
                            @else

                                @if(!$compra->tiene1h())

                                    <form action="{{route('compra.generar.1h',$compra->id)}}" method="post"
                                          class="esperar">

                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-4 mb-1">
                                                {!! Form::label('folio', 'Folio:') !!}
                                                {!! Form::text('folio', null, ['class' => 'form-control','required']) !!}
                                            </div>

                                            <div class="col-sm-8 mb-1 ">
                                                <label for="generar">&nbsp;</label>
                                                <div>
                                                    <button type="submit" id="generar" class="btn btn-outline-primary">
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
                                                <textarea class="form-control" name="observaciones" rows="2" cols="2">
                                                    {{ $compra->compra1h->observaciones }}
                                                </textarea>
                                            </div>

                                            <!-- Submit Field -->
                                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 ">
                                                <a href="{!! route('compras.index') !!}"
                                                   class="btn btn-outline-secondary round me-1">
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


{{-- Modal para anular compra --}}
<div class="modal fade" id="modal-anular" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-sm">
                        @include('compras.show_fields',['compra'=>$compra])
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        @include('compras.tabla_detalles',['compra'=>$compra])
                    </div>
                </div>
            </div> --}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" x-data="{ justificativa: '' }">
                        <form action="{{ route('compras.anular', $compra->id)}}" method="POST">
                            @method('POST')
                            {{ Form::textarea('justificativa_anulacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese motivo de anulación', 'rows' => 4, 'x-model' => 'justificativa', 'minlength' => 25]) }}
                            <span x-show="justificativa.length <= 25" style="color: red;">
                                La justificación debe tener al menos 25 caracteres. / 
                                <b>
                                    <span x-text="justificativa.length" class="text-info"></span>
                                </b>
                            </span>
                            @csrf
                            {{-- lo habilita si justificativa_anulacion es mayor a 25 --}}
                            <template x-if="justificativa.length > 25">
                                <button type="submit"  class="btn btn-danger mt-2" >Anular Ingreso</button>
                            </template>

                            <template x-if="justificativa.length <= 25">
                                <div class="btn btn-danger disabled mt-2" >Anular Ingreso</div>
                            </template>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@push('scripts')
    <script>

        $(".esperarClick").on('click', function (event) {

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

