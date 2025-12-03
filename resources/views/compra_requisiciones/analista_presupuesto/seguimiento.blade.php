@extends('layouts.app')

@section('titulo_pagina', 'Autorizar Compra Requisición' )

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
                       href="{{ route('compra.requisiciones.analista.presupuesto') }}"
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
                {!! Form::model($requisicion, ['url' => route('compra.requisiciones.analista.presupuesto.seguimiento.procesar', $requisicion->id), 'method' => 'patch','class' => 'esperar']) !!}
                <x-compra_requisicion.tarjeta_compra_requisicion
                    :requisicion="$requisicion"
                >
                    @php
                        $detalles = $requisicion->detalles ?? collect();
                        $Q = $Q ?? 'Q';
                        $total = $detalles->sum('sub_total');
                        $totalItems = $detalles->count();
                    @endphp

                    <div class="table-responsive mb-1">
                        <table class="table table-bordered table-hover table-xtra-condensed" id="tablaDetalle"
                               style="margin-bottom: 2px; width:100%;">
                            <thead class="small table-light">
                            <tr class="text-center fw-bold">
                                <td>FUENTE FINANCIAMIENTO</td>
                                <td>NOMBRE</td>
                                <td>CANTIDAD</td>
                                <td>RENGLÓN</td>
                                <td>CÓDIGO DE INSUMO</td>
                                <td>DESCRIPCIÓN</td>
                                <td>NOMBRE DE LA PRESENTACIÓN</td>
                                <td>UNIDAD DE MEDIDA</td>
                                <td>COD. PRESENTACIÓN</td>
                                <td>MONTO ESTIMADO</td>
                                <td>SubTotal</td>
                            </tr>
                            </thead>

                            <tbody class="small">
                            @if($detalles->isEmpty())
                                <tr class="text-center">
                                    <td colspan="10">
                                        <span class="text-muted">No se ha agregado ningún artículo</span>
                                    </td>
                                </tr>
                            @else
                                @foreach($detalles as $detalle)
                                    <tr>
                                        <td style="width: 35%">
                                            <multiselect
                                                v-model="fuenteFinanciamientoSeleccionada[{{$detalle->id}}]"
                                                :options="fuentesFinanciamientos"
                                                label="texto"
                                                placeholder="Seleccione uno..."
                                                :disabled="disabledSelectFuente"
                                            ></multiselect>
                                            <input
                                                type="hidden"
                                                name="fuentes_financiamiento[{{$detalle->id}}]"
                                                :value="fuenteFinanciamientoSeleccionada[{{$detalle->id}}]?.id"/>
                                        </td>
                                        <td>{{ $detalle->item?->nombre }}</td>
                                        <td>{{ nf($detalle->cantidad ?? 0) }}</td>
                                        <td>{{ $detalle->item?->renglon?->numero ?? 'Sin renglón' }}</td>
                                        <td>{{ $detalle->item?->codigo_insumo }}</td>
                                        <td>{!! $detalle->item?->descripcion !!}</td>
                                        <td>{{ $detalle->item?->presentacion?->nombre ?? 'Sin presentación' }}</td>
                                        <td>{{ $detalle->item?->unimed?->nombre ?? 'Sin unidad' }}</td>
                                        <td>{{ $detalle->item?->codigo_presentacion }}</td>
                                        <td class="text-end">
                                            {{ $Q }} {{ nfp($detalle->precio_estimado ?? 0) }}
                                        </td>
                                        <td class="text-end">
                                            {{ $Q }} {{ nfp($detalle->sub_total ?? 0) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot class="small">
                            <tr>
                                {{-- Colspan fijo: 10 columnas totales - 1 = 9 --}}
                                <td colspan="10">
                                    <b class="float-end">Total monto</b>
                                </td>
                                <td class="text-end">
                                    <b>{{ $Q }} {{ number_format($total, 2) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <b class="float-end">Total insumos</b>
                                </td>
                                <td class="text-end">
                                    <b>{{ number_format($totalItems, 0) }}</b>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </x-compra_requisicion.tarjeta_compra_requisicion>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <label for="comentario" class="form-label">Observaciones:</label>
                                <textarea
                                    name="observaciones"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Observaciones (opcional)"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row mb1">

                            <div class="col-sm-4">
                                <button type="button" class="btn btn-outline-secondary round me-1"
                                        data-bs-toggle="modal" data-bs-target="#modalRetornar"
                                >
                                    <i class="fa fa-undo"></i>
                                    Retornar
                                </button>
                            </div>

                            <div class="col-sm-8 text-end">
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-confirma-procesar"
                                    class="btn btn-outline-success round"
                                >
                                    <i class="fa fa-paper-plane"></i>
                                    Enviar a requirente
                                </button>
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
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>

        @include('compra_requisiciones.componentes.modal_retornar', [
            'rutaAccion' => route('compra.requisiciones.analista.presupuesto.seguimiento.retornar',$requisicion->id)
        ])

        @include('compra_requisiciones.componentes.modal_firmar', [
            'rutaFirmar' => route('compra.requisiciones.analista.presupuesto.seguimiento.firmar.imprimir',$requisicion->id ?? 0)
        ])

        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"> <!-- modal-xl para que sea grande -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Vista previa del PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe :src="pdf_firmado" frameborder="0"></iframe>
                        </div>
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
            created() {
                this.getFuentesFinanciemiento();
            },
            async mounted() {
                if (this.flashPdfFirmado) {
                    var myModal = new bootstrap.Modal(document.getElementById('pdfModal'));
                    myModal.show();
                }
            },
            data: {
                fuenteFinanciamientoSeleccionada: [],
                fuentesFinanciamientos: [],
                requisicionDetalles: @json($requisicion->detalles ?? []),
                pdf_firmado: @json($requisicion->pdfFirmado() ?? session('rutaArchivoFirmado') ?? ''),
                flashPdfFirmado: @json(session('rutaArchivoFirmado') ?? false),
                disabledSelectFuente: @json($requisicion->estado_id != \App\Models\CompraRequisicionEstado::ASIGNADA_A_ANALISTA_DE_PRESUPUESTOS),
            },
            methods: {
                firmar() {

                    var myModal = new bootstrap.Modal(document.getElementById('modalFirmar'));
                    myModal.show();
                },
                verPdfFirmado() {
                    if (this.pdf_firmado) {
                        var myModal = new bootstrap.Modal(document.getElementById('pdfModal'));
                        myModal.show();
                    } else {
                        alertWarning('No hay PDF firmado disponible para esta requisición.');
                    }
                },
                async getFuentesFinanciemiento() {
                    try {
                        let response = await axios.get('{{ route('api.financiamiento-fuentes.index') }}');
                        this.fuentesFinanciamientos = response.data.data;
                        this.obtenerFuenteFinanciamiento()
                    } catch (error) {
                        notifyErrorApi(error);
                    }
                },
                obtenerFuenteFinanciamiento() {
                    let olds = @json(old('fuentes_financiamiento', []));
                    let estamosCorrigiendo = olds && Object.keys(olds).length > 0;

                    this.requisicionDetalles.forEach(detalle => {
                        let targetId;

                        if (estamosCorrigiendo) {
                            targetId = olds[detalle.id];
                        } else {
                            targetId = detalle.financiamiento_fuente_id;
                        }

                        let fuente = this.fuentesFinanciamientos.find(f => f.id == targetId);

                        this.fuenteFinanciamientoSeleccionada[detalle.id] = fuente || null;
                    });
                }
            },
        });
    </script>
@endpush
