{{$solicitud->codigo}}

{{-- Modal de solicitud --}}
<div class="modal fade" id="modal-detalles-{{$solicitud->id}}" tabindex="-1" aria-labelledby="modalLabel{{$solicitud->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{$solicitud->id}}">Detalles de Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body text-uppercase">
                <div class="row">
                    <div class="col-12">
                        <div class="card border border-primary">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="tabs-{{$solicitud->id}}" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab-info-tab{{$solicitud->id}}" data-bs-toggle="tab" data-bs-target="#tab-info{{$solicitud->id}}" type="button" role="tab" aria-controls="tab-info{{$solicitud->id}}" aria-selected="true">
                                            Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-bitacora-tab{{$solicitud->id}}" data-bs-toggle="tab" data-bs-target="#tab-bitacora{{$solicitud->id}}" type="button" role="tab" aria-controls="tab-bitacora{{$solicitud->id}}" aria-selected="false">
                                            Bitácora
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <div class="tab-content" id="tabsContent-{{$solicitud->id}}">
                                    <div class="tab-pane fade show active" id="tab-info{{$solicitud->id}}" role="tabpanel" aria-labelledby="tab-info-tab{{$solicitud->id}}">
                                        <div class="row">
                                            <div class="col-12 text-sm" style="font-size: 14px">
                                                @include('solicitudes.show_fields',['solicitude'=>$solicitud])
                                            </div>
                                            <div class="col-12">
                                                @include('solicitudes.tabla_detalles',['solicitude'=>$solicitud])
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-bitacora{{$solicitud->id}}" role="tabpanel" aria-labelledby="tab-bitacora-tab{{$solicitud->id}}">
                                        <div class="row">
                                            <div class="col">
                                                @include('layouts.partials.bitacoras', ["bitacoras" => $solicitud->bitacoras->sortByDesc('created_at')])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- /.card-body --}}
                        </div> {{-- /.card --}}
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
