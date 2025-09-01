
<!-- Modal -->
<div class="modal fade" id="modalCancelarIngresoAlmacen" tabindex="-1" role="dialog"
     aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('compras.destroy', $compra->id)}}" method="POST"
              id="delete-form{{$compra->id}}">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">
                        Eliminar ingreso a almacén
                    </h4>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">
                        ¿Está seguro que desea eliminar el ingreso a almacén?
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">No
                    </button>
                    <button data-toggle="tooltip"
                            title="Cancelar Solicitud de Compra"
                            class='btn btn-outline-danger float-start'>

                        Sí, Eliminar
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
