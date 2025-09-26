<button  type="button"
    data-toggle="tooltip" title="Ver detalles"
    class="btn btn-icon btn-outline-info rounded-circle"
    data-bs-toggle="modal"
    data-bs-target="#modal-detalles-{{ $compra->id }}">
    <i class="fa fa-eye"></i>
</button>

@if($compra->puedeEditar())
    <a href="{{ route('compras.edit', $compra->id) }}" class='btn btn-icon btn-outline-primary rounded-circle' data-toggle="tooltip" title="Editar">
        <i class="fa fa-edit"></i>
    </a>
@endif

@include('compras.partials.boton_imprimir')

@can('Anular Ingreso de almacen')
    @if($compra->puedeAnular())
        <button  type="button"
            data-toggle="tooltip" title="Anular Ingreso"
            class="btn btn-icon btn-outline-danger rounded-circle"
            data-bs-toggle="modal"
            data-bs-target="#modal-anular-{{ $compra->id }}">
            <i class="fa fa-undo-alt"></i>
        </button>
    @endif
    @if($compra->puedeCancelar() )
        <button  type="button"
            data-toggle="tooltip" title="Cancelar Solicitud de Compra"
            class="btn btn-icon btn-outline-warning rounded-circle"
            data-bs-toggle="modal"
            data-bs-target="#modal-delete-{{ $compra->id }}">
            <i class="fas fa-ban" ></i>
        </button>
    @endif
@endcan
