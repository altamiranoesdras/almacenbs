{{-- Modal para anular compra --}}
<div class="modal fade" id="modal-anular-{{$compra->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-sm">
                        @include('compras.show_fields',['compra'=>$compra])
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        @include('compras.tabla_detalles',['compra'=>$compra])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-12" x-data="{ justificativa: '' }">
                        <form action="{{ route('compras.anular', $compra->id) }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-1">
                                <label for="justificativa_anulacion" class="form-label fw-bold">
                                    Motivo de anulación
                                </label>
                                <textarea
                                    id="justificativa_anulacion"
                                    name="justificativa_anulacion"
                                    class="form-control"
                                    placeholder="Ingrese el motivo de anulación..."
                                    rows="4"
                                    minlength="25"
                                    x-model="justificativa"
                                    required
                                ></textarea>
                                <div class="form-text">
                                    Mínimo 25 caracteres requeridos.
                                </div>

                                <div class="mt-1">
                                    <small class="text-danger" x-show="justificativa.length < 25">
                                        La justificación debe tener al menos 25 caracteres.
                                        (<span x-text="justificativa.length"></span>/25)
                                    </small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                    :disabled="justificativa.length < 25"
                                >
                                    <i class="fa fa-ban me-1"></i> Anular Ingreso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
