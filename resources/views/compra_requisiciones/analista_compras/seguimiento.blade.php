@extends('layouts.app')

@section('titulo_pagina', 'Autorizar Compra Requisición' )
@include('layouts.plugins.bootstrap_fileinput')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Gestionar Requisición de Compra
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
                       href="{{ route('compra.requisiciones.analista.compras') }}"
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
                    {!! Form::model($requisicion, ['url' => route('compra.requisiciones.analista.compras.seguimiento.procesar', $requisicion->id), 'method' => 'patch','class' => 'esperar']) !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <label for="justificacion" class="form-label">Tipo de Proceso:</label>
                                <multiselect
                                    v-model="tiposProcesoSeleccionado"
                                    label="nombre"
                                    placeholder="Seleccione uno..."
                                    :options="tiposProcesos"
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div
                                v-if="tiposProcesoSeleccionado?.id == {{\App\Models\CompraRequisicionProcesoTipo::NOG}}"
                                class="col-6 mb-1"
                            >
                                <label for="justificacion" class="form-label">Numero NOG:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="numero_nog"
                                    value="{{ $requisicion->nog ?? old('numero_nog') }}"
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div
                                v-if="tiposProcesoSeleccionado?.id == {{\App\Models\CompraRequisicionProcesoTipo::NPG}}"
                                class="col-6 mb-1"
                            >
                                <label for="justificacion" class="form-label">Numero NPG:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="numero_npg"
                                    value="{{ $requisicion->npg ?? old('numero_npg') }}"
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div class="col-6 mb-1">
                                <label for="concurso" class="form-label">Tipo Adquisición:</label>
                                <multiselect
                                    v-model="tipoAdquisicionSeleccionado"
                                    :options="tipoAdquisiciones"
                                    label="nombre"
                                    placeholder="Seleccione uno..."
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div class="col-6 mb-1">
                                <label for="concurso" class="form-label">Tipo Concurso:</label>
                                <multiselect
                                    v-model="tiposConcursoSeleccionado"
                                    :options="tiposConcursos"
                                    label="nombre"
                                    placeholder="Seleccione uno..."
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div class="col-6 mb-1">
                                <label for="justificacion" class="form-label">Proveedor:</label>
                                <multiselect
                                    v-model="proveedorSeleccionado"
                                    :options="proveedores"
                                    label="nombre"
                                    placeholder="Seleccione uno..."
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>
                            <div class="col-6 mb-1">
                                <label for="numero_adjudicacion" class="form-label">Numero Adjudicación:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="numero_adjudicacion"
                                    value="{{ $requisicion->numero_adjudicacion ?? old('numero_adjudicacion') }}"
                                    :disabled="deshAbilitarCampos"
                                />
                            </div>


                            @if($requisicion->estado_id == \App\Models\CompraRequisicionEstado::INICIO_DE_GESTION)
                                <div class="col-6 mb-1">
                                    <label for="numero_orden" class="form-label">Numero Adjudicación:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="numero_orden"
                                        value="{{ $requisicion->numero_orden ?? old('numero_orden') }}"
                                    />
                                </div>

                                <div class="col-6 mb-1">
                                    <label for="numero_orden" class="form-label">Orden de compra:</label>
                                    <input type="file" name="orden_compra" class="form-control" id="orden_compra">
                                </div>
                            @endif


                            <div class="col-12 mb-1">
                                Comentario:
                                <textarea
                                    name="comentario"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Justificación de la compra"
                                ></textarea>
                            </div>

                            <input type="hidden" name="proveedor_id"
                                   :value="proveedorSeleccionado ? proveedorSeleccionado.id : ''">
                            <input type="hidden" name="tipo_proceso_id"
                                   :value="tiposProcesoSeleccionado ? tiposProcesoSeleccionado.id : ''">
                            <input type="hidden" name="concurso_id"
                                   :value="tiposConcursoSeleccionado ? tiposConcursoSeleccionado.id : ''">
                            <input type="hidden" name="tipo_adquisicion_id"
                                   :value="tipoAdquisicionSeleccionado ? tipoAdquisicionSeleccionado.id : ''">


                        </div>

                        <div class="card-footer">
                            <div class="row mb1">

                                <div class="col-sm-4">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-secondary round me-1"
                                            data-bs-toggle="modal" data-bs-target="#modalRetornar"
                                    >
                                        <i class="fa fa-undo"></i>
                                        Retornar
                                    </button>
                                </div>


                                <div class="col-sm-4 text-center">

                                    {{--                                    @if(!$requisicion->tiene_firma_autorizador)--}}
                                    {{--                                        <button type="button" class="btn btn-outline-info round" @click="firmar()">--}}
                                    {{--                                            Firmar--}}
                                    {{--                                        </button>--}}
                                    {{--                                    @else--}}

                                    {{--                                        <button type="button" class="btn btn-outline-info round" data-bs-toggle="modal"--}}
                                    {{--                                                data-bs-target="#modalImprimir">--}}
                                    {{--                                            Ver PDF Firmado--}}
                                    {{--                                        </button>--}}
                                    {{--                                    @endif--}}

                                </div>

                                <div class="col-sm-4 text-end">
                                    @if($requisicion->estado_id == \App\Models\CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS)
                                        <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-confirma-procesar"
                                                class="btn btn-success round">
                                            <i class="fa fa-paper-plane"></i>
                                            Iniciar Proceso
                                        </button>
                                    @endif

                                    @if($requisicion->estado_id == \App\Models\CompraRequisicionEstado::INICIO_DE_GESTION)
                                        <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modal-confirma-procesar"
                                                class="btn btn-success round">
                                            <i class="fa fa-paper-plane"></i>
                                            Enviar a Almacén
                                        </button>
                                    @endif

                                </div>

                            </div>
                            <div class="modal fade modal-info" id="modal-confirma-procesar">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Autorizar Requisición!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Seguro que desea continuar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">NO
                                            </button>
                                            <button type="submit" class="btn btn-primary" name="solicitar" value="1">SI
                                            </button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>

                        {!! Form::close() !!}

                        <div class="modal fade" id="modalImprimir" tabindex="-1" role="dialog"
                             aria-labelledby="modelTitleId"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form
                                    action="{{ route('compra.requisiciones.autorizador.firmar.imprimir',$requisicion->id ?? 0) }}"
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

        <div class="modal fade" id="modalRetornar" tabindex="-1" role="dialog"
             aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">
                            Retornar Requisición
                        </h4>
                        <button type="button" class="btn-close"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form
                        action="{{route('compra.requisiciones.analista.presupuesto.seguimiento.retornar',$requisicion->id)}}"
                        method="post" class="esperar">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <!--campo motivo-->

                                <div class="col">
                                    <label for="motivo">Motivo:</label>
                                    <textarea
                                        name="comentario"
                                        id="motivo"
                                        class="form-control"
                                        rows="3"
                                        required
                                    >
                                    </textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-outline-success">
                                Retornar
                            </button>
                        </div>
                    </form>
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
                    async mounted() {
                        await this.getTipoProcesos()
                        await this.getTipoConcursos()
                        await this.getProveedores()
                        await this.getTipoAdquisiciones()
                        await this.obtenerDatos()
                    },
                    created() {

                    },
                    data: {
                        justificacion: @json($requisicion->justificacion ?? ''),
                        tiposProcesos: [],
                        tiposProcesoSeleccionado: null,
                        tiposConcursos: [],
                        tiposConcursoSeleccionado: null,
                        proveedores: [],
                        proveedorSeleccionado: null,
                        tipoAdquisiciones: [],
                        tipoAdquisicionSeleccionado: null,
                        deshAbilitarCampos: @json($requisicion->estado_id != \App\Models\CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_COMPRAS),

                    },
                    methods: {
                        firmar() {

                            var myModal = new bootstrap.Modal(document.getElementById('modalFirmar'));
                            myModal.show();
                        },
                        async getTipoProcesos() {
                            try {
                                let response = await axios.get('{{ route('api.compra_requisicion_proceso_tipos.index') }}');
                                this.tiposProcesos = response.data.data;
                            } catch (error) {
                                notifyErrorApi(error);
                            }
                        },
                        async getTipoConcursos() {
                            try {
                                let response = await axios.get('{{ route('api.compra_requisicion_tipo_concursos.index') }}');
                                this.tiposConcursos = response.data.data;
                            } catch (error) {
                                notifyErrorApi(error);
                            }
                        },
                        async getProveedores() {
                            try {
                                let response = await axios.get('{{ route('api.proveedores.index') }}');
                                this.proveedores = response.data.data;
                            } catch (error) {
                                notifyErrorApi(error);
                            }
                        },
                        async getTipoAdquisiciones() {
                            try {
                                let response = await axios.get('{{ route('api.requisicion_tipo_adquisiciones.index') }}');
                                this.tipoAdquisiciones = response.data.data;
                            } catch (error) {
                                notifyErrorApi(error);
                            }
                        },
                        obtenerDatos() {
                            let tipo_proceso_id = @json(old('tipo_proceso_id', $requisicion->tipo_proceso_id));
                            let proveedorActualId = @json(old('proveedor_id', $requisicion->proveedor_adjudicado));
                            let tipoConsursoId = @json(old('concurso_id', $requisicion->tipo_concurso_id));
                            let tipoAdquisicionId = @json(old('tipo_adquisicion_id', $requisicion->tipo_adquisicion_id));

                            if (tipo_proceso_id) {
                                this.tiposProcesoSeleccionado = this.tiposProcesos.find(tipo => tipo.id === parseInt(tipo_proceso_id));
                            }
                            if (proveedorActualId != null) {
                                this.proveedorSeleccionado = this.proveedores.find(proveedor => proveedor.id === parseInt(proveedorActualId));
                            }
                            if (tipoConsursoId) {
                                this.tiposConcursoSeleccionado = this.tiposConcursos.find(tipo => tipo.id === parseInt(tipoConsursoId));
                            }
                            if (tipoAdquisicionId) {
                                this.tipoAdquisicionSeleccionado = this.tipoAdquisiciones.find(tipo => tipo.id === parseInt(tipoAdquisicionId));
                            }
                        }
                    }
                });
                $(function () {
                    $("#orden_compra").fileinput({
                        language: "es",
                        initialPreview: @json(getLogo()),
                        dropZoneEnabled: true,
                        maxFileCount: 1,
                        maxFileSize: 2000,
                        showUpload: false,
                        initialPreviewAsData: true,
                        showBrowse: true,
                        showRemove: true,
                        theme: "fa6",
                        browseOnZoneClick: true,
                        allowedPreviewTypes: ["image"],
                        allowedFileTypes: ["image"],
                        initialPreviewFileType: 'image',
                    });
                });
            </script>
    @endpush
