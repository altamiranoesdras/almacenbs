@extends('layouts.app')

@section('titulo_pagina', 'Editar Compra Requisicion' )

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Editar Compra Requisición
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
                       href="{{ route('compra.requisiciones.mis.requisiciones') }}"
                    >
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body" id="editarRequisicion">

        <div class="row">
            <div class="col-12">

                @include('layouts.partials.request_errors')

                @include('compra_requisiciones.componentes.tarjeta_compra_requisicion', ['requisicion' => $requisicion,'abierta' => true])

                <div class="card">

                    {!! Form::model($requisicion, ['url' => route('compra.requisiciones.update', $requisicion->id), 'method' => 'patch','class' => 'esperar']) !!}

                    <div class="card-body">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-12 mb-1">
                                JUSTIFICACIÓN DE LA COMPRA
                                <textarea
                                    name="justificacion"
                                    id="justificacion"
                                    v-model="justificacion"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Justificación de la compra"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row mb1">

                            <div class="col-sm-4">
                                <button type="button" class="btn btn-outline-danger round" data-bs-toggle="modal"
                                        data-target="#modalAnular">
                                    <i class="fa fa-ban"></i> Anular
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-outline-success round">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>
                            <div class="col-sm-4 text-end">
                                <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#modal-confirma-procesar"
                                        class="btn btn-outline-primary round">
                                    <i class="fa fa-paper-plane"></i>
                                    Enviar a analista de presupuestos
                                </button>
                            </div>
                        </div>
                        <div class="modal fade modal-info" id="modal-confirma-procesar">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Enviar a analista de presupuestos!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Seguro que desea continuar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-outline-primary" name="solicitar" value="1">SI
                                        </button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl"> <!-- modal-xl para que sea grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Vista previa del PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Aquí va el visor PDF -->
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ session('rutaArchivoFirmado') }}"
                                frameborder="0"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @if(session('rutaArchivoFirmado'))
        var myModal = new bootstrap.Modal(document.getElementById('pdfModal'));
        myModal.show();
        @endif

        new Vue({
            el: '#editarRequisicion',
            name: 'editarRequisicion',
            mounted() {
                console.log('Instancia vue montada');
            },
            created() {
                console.log('Instancia vue creada');
            },
            data: {
                justificacion: @json($requisicion->justificacion ?? ''),
            },
            methods: {
                firmar() {
                    //valida justificación
                    if (this.justificacion.trim() === '') {
                        alertWarning('Debe ingresar una justificación de la compra');
                        return;
                    }

                    var myModal = new bootstrap.Modal(document.getElementById('modalFirmar'));
                    myModal.show();
                }
            }
        });
    </script>
@endpush
