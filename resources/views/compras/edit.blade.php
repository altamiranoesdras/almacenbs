@extends('layouts.app')

@section('titulo_pagina', 'Editar Ingreso Almacén')

@section('content')

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

                @include('compras.partials.tarjeta_ingreso_almacen', ['compra'=> $compra,'abierta' => true])

                <div class="card ">
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
                            @if($compra->puedeGestionar1h())
                                @if(!$compra->tiene1h())
                                    {{--Alerta--}}
                                    <h4 class="text-center text-info">
                                        El operador no ha generado el formulario 1H
                                    </h4>
                                @else
                                    @include('compras.partials.datos_1h',['compra' => $compra,'editable' => false])

                                    <hr>
                                    <!-- Submit Field -->
                                    <div class="row">

                                        <div class="col ">
                                            <a href="{!! route('compras.index') !!}"
                                               class="btn btn-outline-secondary round me-1">
                                                <i class="fa fa-arrow-left"></i>
                                                Regresar
                                            </a>
                                        </div>
                                        <div class="col text-center">
                                            <a href="{{route('compras.h1.pdf',$compra->id)}}" target="_blank"
                                               class='btn btn-outline-primary round ' data-toggle="tooltip"
                                               title="Imprimir 1H">
                                                <i class="fas fa-print"></i>
                                                Imprimir 1H
                                            </a>
                                        </div>


                                    </div>
                                @endif
                            @else
                                <h4 class="text-center text-info">
                                    Debe dar ingreso al almacén para poder generar formulario 1H
                                </h4>
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

