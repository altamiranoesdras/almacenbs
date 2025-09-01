
{{-- Modal para anular compra --}}
<div class="modal fade" id="modalAnularaIngresoAlmacen" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">
                    Anular Ingreso Almacén
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" x-data="{ justificativa: '' }">
                        <form action="{{ route('compras.anular', $compra->id)}}" method="POST">
                            @method('POST')
                            {{ Form::textarea('justificativa_anulacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese motivo de anulación', 'rows' => 4, 'x-model' => 'justificativa', 'minlength' => 25]) }}
                            <span x-show="justificativa.length <= 25" style="color: red;">
                                La justificación debe tener al menos 25 caracteres. /
                                <b>
                                    <span x-text="justificativa.length" class="text-info"></span>
                                </b>
                            </span>
                            @csrf
                            {{-- lo habilita si justificativa_anulacion es mayor a 25 --}}
                            <template x-if="justificativa.length > 25">
                                <button type="submit" class="btn btn-danger mt-2">Anular Ingreso</button>
                            </template>

                            <template x-if="justificativa.length <= 25">
                                <div class="btn btn-danger disabled mt-2">Anular Ingreso</div>
                            </template>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
