<button  type="button"
    data-toggle="tooltip" title="Ver detalles"
    class="btn btn-icon btn-outline-info rounded-circle"
    data-bs-toggle="modal"
    data-bs-target="#modal-detalles-{{ $compra->id }}">
    <i class="fa fa-eye"></i>
</button>

@if($compra->puedeAutorizar())
    <a href="{{ route('bandejas.compras1h.autorizar.gestionar', $compra->id) }}" class='btn btn-icon btn-outline-primary rounded-circle' data-toggle="tooltip" title="Autorizar">
        <i class="fa fa-edit"></i>
    </a>
@endif


@include('compras.partials.boton_imprimir')

@can('Anular Ingreso de almacén')
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
