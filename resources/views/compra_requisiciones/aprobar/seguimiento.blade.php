@extends('layouts.app')

@section('titulo_pagina', 'Aprobar Compra Requisición' )

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Aprobar Compra Requisición
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
                       href="{{ route('compra.requisiciones.aprobar') }}"
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
                @include('compra_requisiciones.componentes.tarjeta_compra_requisicion', ['requisicion' => $requisicion])

                <div class="card">

                    {!! Form::model($requisicion, ['url' => route('compra.requisiciones.aprobar.store', $requisicion->id), 'method' => 'patch','class' => 'esperar']) !!}

                    <div class="card-body">
                        <div class="row">
{{--                            @include('compra_requisiciones.show_fields')--}}
{{--                            @include('compra_requisiciones.tabla_detalles_requisicion')--}}
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-12 mb-1">--}}
{{--                                JUSTIFICACIÓN DE LA COMPRA--}}
{{--                                <textarea--}}
{{--                                    name="justificacion"--}}
{{--                                    id="justificacion"--}}
{{--                                    v-model="justificacion"--}}
{{--                                    class="form-control"--}}
{{--                                    rows="2"--}}
{{--                                    placeholder="Justificación de la compra"--}}
{{--                                ></textarea>--}}
{{--                            </div>--}}

{{--                            --}}{{--                        <div class="col-6 mb-1">--}}
{{--                            --}}{{--                            subproductos--}}
{{--                            --}}{{--                            <table class="table table-sm">--}}
{{--                            --}}{{--                                <tbody >--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->subproductos)[0] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->subproductos)[1] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->subproductos)[2] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->subproductos)[3] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                </tbody>--}}
{{--                            --}}{{--                            </table>--}}

{{--                            --}}{{--                        </div>--}}
{{--                            --}}{{--                        <div class="col-6 mb-1">--}}
{{--                            --}}{{--                            PARTIDAS PRESUPUESTARIAS--}}
{{--                            --}}{{--                            <table class="table table-sm">--}}
{{--                            --}}{{--                                <tbody>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->partidas)[0] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->partidas)[1] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->partidas)[2] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                <tr>--}}
{{--                            --}}{{--                                    <td>--}}
{{--                            --}}{{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
{{--                            --}}{{--                                               value="{{explode('|',$compraSolicitud->partidas)[3] ?? ''}}">--}}
{{--                            --}}{{--                                    </td>--}}
{{--                            --}}{{--                                </tr>--}}
{{--                            --}}{{--                                </tbody>--}}
{{--                            --}}{{--                            </table>--}}

{{--                            --}}{{--                        </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="card-footer">
                        <div class="row mb1">

                            <div class="col-sm-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger round" data-bs-toggle="modal"
                                        data-target="#modalAnular">
                                    <i class="fa fa-ban"></i> Anular
                                </button>
                            </div>


                            <div class="col-sm-3 text-center">

                                @if(!$requisicion->tiene_firma_aprobador)
                                    <button type="button" class="btn btn-outline-info round" @click="firmar()">
                                        Firmar
                                    </button>
                                @else

                                    <button type="button" class="btn btn-outline-info round" data-bs-toggle="modal"
                                            data-bs-target="#modalImprimir">
                                        Ver PDF Firmado
                                    </button>
                                @endif

                            </div>

                            <div class="col-sm-3 text-center">

                                <button type="submit" class="btn btn-outline-success round">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>

                            @if($requisicion->puedeAprobarse())
                                <div class="col-sm-3 text-end">
                                    <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-confirma-procesar"
                                            class="btn btn-outline-primary round">
                                        <i class="fa fa-paper-plane"></i>
                                        Aprobar y Enviar
                                    </button>
                                </div>
                            @endif

                        </div>
                        <div class="modal fade modal-info" id="modal-confirma-procesar">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Aprobar Requisición!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Seguro que desea continuar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-primary" name="solicitar" value="1">SI
                                        </button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                    {!! Form::close() !!}

                    <div class="modal fade" id="modalFirmar" tabindex="-1" role="dialog"
                         aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form
                                action="{{ route('compra.requisiciones.aprobador.firmar.imprimir',$requisicion->id ?? 0) }}"
                                method="POST" class="esperar">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId">
                                            Credenciales de firma
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            {{-- Usuario --}}
                                            <div class="col-12 mb-1">
                                                <label for="usuario_firma" class="form-label">Usuario</label>
                                                <input class="form-control" type="text" name="usuario_firma"
                                                       id="usuario_firma"
                                                       value="{{ auth()->user()->email }}">
                                            </div>

                                            {{-- Contraseña de firma --}}
                                            <div class="col-12 mb-1">
                                                <label for="password_firma" class="form-label">Contraseña Firma</label>
                                                <input class="form-control" type="password" name="password_firma"
                                                       id="password_firma"
                                                       placeholder="******" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary round" target="_blank">
                                            <i class="fa fa-print"></i> Firmar e imprimir
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalImprimir" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form
                                action="{{ route('compra.requisiciones.aprobador.firmar.imprimir',$requisicion->id ?? 0) }}"
                                method="POST" class="esperar">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId">
                                            Imprimir Requisición Firmada
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                La requisición ya fue firmada por el solicitante.
                                                <br>
                                                Puede imprimir el documento firmado.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary round" target="_blank">
                                            <i class="fa fa-print"></i> Imprimir
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

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

                    var myModal = new bootstrap.Modal(document.getElementById('modalFirmar'));
                    myModal.show();
                }
            }
        });
    </script>
@endpush
