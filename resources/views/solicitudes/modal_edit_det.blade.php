<!-- Modal Editar detalle solicitud -->
<div class="modal fade" id="modalEditDetalle">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form method="POST" @submit.prevent="updateDet(detalleEdita.id)">

                <div class="modal-header">
                    <h5 class="modal-title">Editar detalle </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <!-- Titulo Field -->
                        <div class="col-sm-6 mb-1">
                            {!! Form::label('titulo', 'Cantidad:') !!}
                            <input type="text"  class="form-control" required="required" v-model="detalleEdita.cantidad">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off" :disabled="loadingBtnUpdateDet">
                        <i  v-show="loadingBtnUpdateDet" class="fa fa-spinner fa-spin"></i> Guardar
                    </button>
                </div>

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /. Modal Editar detalle solicitud -->
