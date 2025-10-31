{{$requisicion->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$requisicion->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @include('compra_requisiciones.componentes.tarjeta_compra_requisicion',[
                                                                            'abierta' => true,
                                                                             'requisicion' => $requisicion,
                                                                             'camposDeTabla' => ['nombre', 'cantidad']
                                                                             ])
            <div class="modal-footer" style="display: block !important;">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-target="#modalRegresar{{$requisicion->id}}"
                        >
                            <i class="fa fa-arrow-left"></i> Regresar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
