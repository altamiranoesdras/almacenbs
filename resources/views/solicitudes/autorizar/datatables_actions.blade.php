@can('Ver Requisición')
    <button  type="button"
             class="btn btn-secondary btn-xs"
             data-bs-toggle="modal"
             data-bs-target="#modal-detalles-{{ $id }}"
             title="Ver detalles">
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-icon btn-outline-info rounded-circle' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

