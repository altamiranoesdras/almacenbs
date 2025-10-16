@can('Ver Rrhh Unidad Tipos')
    <a href="{{ route('rrhhUnidadTipos.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Rrhh Unidad Tipos')
    <a href="{{ route('rrhhUnidadTipos.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Rrhh Unidad Tipos')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('rrhhUnidadTipos.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

