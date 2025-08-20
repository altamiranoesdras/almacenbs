@can('Ver Rrhh Unidads')
    <a  href="{{ route('rrhhUnidad.create', $id) }}"
        class="btn btn-sm btn-icon btn-outline-success  me-50"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar Subunidad"
        aria-label="Crear">
        <i class="fa fa-plus"></i>
    </a>
@endcan

@can('Editar Rrhh Unidads')
    <a  href="{{ route('rrhhUnidades.edit', $id) }}"
        class="btn btn-sm btn-icon btn-outline-info  me-50"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"
        aria-label="Editar">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Rrhh Unidads')
    <button type="button"
            class="btn btn-sm btn-icon btn-outline-danger "
            data-id="{{ $id }}"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"
            aria-label="Eliminar"
            onclick="deleteItemDt(this)">
        <i class="fa fa-trash-alt"></i>
    </button>

    <form action="{{ route('rrhhUnidades.destroy', $id) }}" method="POST" id="delete-form-{{ $id }}" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endcan
