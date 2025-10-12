{{-- Modal para anular compra --}}
<div class="modal fade" id="modalAnularaIngresoAlmacen" tabindex="-1" aria-labelledby="tituloAnularIngreso" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="color:#0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloAnularIngreso">Anular Ingreso Almacén</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body" x-data="{ justificativa: @js(old('justificativa_anulacion','')) }">
                <form action="{{ route('compras.anular', $compra->id) }}" method="POST" novalidate>
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="justificativa_anulacion" class="form-label">Motivo de anulación</label>
                        <textarea
                            id="justificativa_anulacion"
                            name="justificativa_anulacion"
                            class="form-control @error('justificativa_anulacion') is-invalid @enderror"
                            placeholder="Ingrese motivo de anulación"
                            rows="4"
                            minlength="25"
                            required
                            x-model="justificativa"
                        >@if(old('justificativa_anulacion')){{ old('justificativa_anulacion') }}@endif</textarea>

                        <div class="form-text d-flex justify-content-between">
                            <span>La justificación debe tener al menos 25 caracteres.</span>
                            <span>
                <b x-text="justificativa.length"></b> / mínimo 25
              </span>
                        </div>

                        @error('justificativa_anulacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button
                            type="submit"
                            class="btn btn-danger"
                            :disabled="justificativa.length < 25"
                        >
                            Anular Ingreso
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
