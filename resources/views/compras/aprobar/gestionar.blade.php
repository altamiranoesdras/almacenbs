@extends('layouts.app')

@section('titulo_pagina', 'Aprobar Ingreso Almacén')

@section('content')
    <x-content-header titulo="Aprobar Ingreso Almacén">
        <a class="btn btn-outline-secondary round"
           href="{!! route('bandejas.compras1h.aprobador') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">
                Regresar
            </span>
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="row">
            <div class="col-lg-12">

                @include('compras.partials.tarjeta_ingreso_almacen', ['compra'=> $compra])

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
                                        Debe generar el formulario 1H para poder aprobarlo
                                    </h4>
                                @else
                                    <form action="{{route('bandejas.compras1h.aprobar.procesar',$compra->id)}}" method="post" class="esperar">
                                        @csrf
                                        @include('compras.partials.datos_1h',['compra' => $compra,'editable' => false])

                                        <hr>
                                        <!-- Submit Field -->
                                        <div class="row">

                                            <div class="col ">


                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-secondary round me-1"
                                                        data-bs-toggle="modal" data-bs-target="#modalRegresarOperador">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Regresar a Operador
                                                </button>

                                            </div>
                                            <div class="col text-center">
                                                <div class="btn-group">
                                                    <button type="button"
                                                            class="btn btn-outline-primary round dropdown-toggle"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                        <i class="fas fa-print"></i> Imprimir
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('compras.h1.pdf', $compra->id) }}" target="_blank">
                                                                <i class="fas fa-file-pdf"></i> PreImpreso
                                                            </a>

                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('compras.h1.pdf.digital', $compra->id) }}" target="_blank">
                                                                <i class="fas fa-file-alt"></i> Digital
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            @if($compra->puedeAprobar())

                                                <div class="col text-end">

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success round"
                                                            data-bs-toggle="modal" data-bs-target="#modalEnviarAutorizacion">
                                                        <i class="fa fa-paper-plane"></i>
                                                        Enviar a Autorización
                                                    </button>
                                                    <div class="modal fade" id="modalEnviarAutorizacion" tabindex="-1" role="dialog"
                                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modelTitleId">
                                                                        Enviar a Autorización
                                                                    </h4>
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4 class="text-center">
                                                                        ¿Está seguro que desea enviar este 1H a autorización?
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary round"
                                                                            data-bs-dismiss="modal">
                                                                        No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success round">
                                                                        Sí, Enviar a Autorización
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>


                                    </form>
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


        <!-- Modal Regresar a Operador -->
        <div class="modal fade" id="modalRegresarOperador" tabindex="-1" role="dialog"
             aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">
                            Regresar a Operador
                        </h4>
                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('bandejas.compras1h.aprobar.regresar',$compra->id)}}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <!--campo motivo-->

                                <div class="col">
                                    <label for="motivo">Motivo</label>
                                    <textarea name="motivo" id="motivo" class="form-control"
                                              rows="3" required></textarea>
                                </div>
                            </div>

                            <p class="text-center">
                                El operador podrá editar el formulario y volver a enviarlo para su aprobación.
                            </p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-outline-success">
                                Regresar a Operador
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



@push('scripts')
    <script>

    </script>
@endpush

