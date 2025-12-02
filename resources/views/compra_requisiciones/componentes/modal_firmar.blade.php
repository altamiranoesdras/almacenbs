<div class="modal fade" id="modalFirmar" tabindex="-1" role="dialog"
     aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form
            action="{{$rutaFirmar}}"
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
