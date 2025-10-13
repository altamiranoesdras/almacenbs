@extends('layouts.app')

@section('titulo_pagina', 'Operar Ingreso Almacén')

@section('content')
    <x-content-header titulo="Operar Ingreso Almacén">
        <a class="btn btn-outline-secondary round"
           href="{!! route('bandejas.compras1h.operador') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">
                Regresar
            </span>
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="row">
            <div class="col-lg-12">

                @include('compras.partials.tarjeta_ingreso_almacen', ['compra'=> $compra,'abierta' => $compra->estaPendienteRecibir()])

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
                                    @include('compras.partials.formulario_generar_1h')
                                @else
                                    <form action="{{route('bandejas.compras1h.operador.procesar',$compra->id)}}" method="post" class="esperar">
                                        @csrf

                                        @include('compras.partials.datos_1h',['compra' => $compra,'editable' => $compra->puedeOperar()])

                                        <hr>
                                        <!-- Submit Field -->
                                        <div class="row">

                                            <div class="col ">


                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-secondary round me-1"
                                                        data-bs-toggle="modal" data-bs-target="#ModalRegresarEdicion">
                                                    Regresar para editar
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalRegresarEdicion" tabindex="-1" role="dialog"
                                                     aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="modelTitleId">
                                                                    Regresar para editar
                                                                </h4>
                                                                <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Seguro que desea regresar este 1H para editarlo?

                                                                <p class="text-danger">
                                                                    Tenga en cuenta que sí ya agrego la descripción adicional para el 1h debera volver a agregarla
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                    No, Cancelar
                                                                </button>
                                                                <button type="button" class="btn btn-primary">
                                                                    <a href="{!! route('compras.edit',$compra->id) !!}"
                                                                       class="text-white">
                                                                        Sí, Regresar para editar
                                                                    </a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        @if($compra->puedeOperar())
                                                <div class="col text-center">
                                                    <button type="submit" class="btn btn-outline-success round">
                                                        <i class="fa fa-save "></i>
                                                        Guardar
                                                    </button>
                                                </div>

                                                <div class="col text-end">

                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success"
                                                            data-bs-toggle="modal" data-bs-target="#modalEnviarAprobacion">
                                                        <i class="fa fa-paper-plane"></i>
                                                        Enviar a Aprobación
                                                    </button>
                                                    <div class="modal fade" id="modalEnviarAprobacion" tabindex="-1" role="dialog"
                                                         aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="modelTitleId">
                                                                        Enviar a Aprobación
                                                                    </h4>
                                                                    <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h4 class="text-center">
                                                                        ¿Está seguro que desea enviar este 1H a aprobación?
                                                                    </h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary" name="enviarAprobacion" value="1">
                                                                        Sí, Enviar a Aprobación
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
    </div>

@endsection

@push('scripts')
    <script>


    </script>
@endpush

