
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
                action="{{$rutaAccion}}"
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
