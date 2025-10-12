<!--modal para cancelar compra-->
<div class="modal fade" id="modal-delete-{{ $compra->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-delete-label">Cancelar Solicitud de Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de cancelar la solicitud de compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="{{ route('compras.destroy', $compra->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancelar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>
