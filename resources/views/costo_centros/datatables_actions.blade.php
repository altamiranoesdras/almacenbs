@can('Ver Costo Centros')
    <a href="{{ route('costoCentros.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Costo Centros')
    <a href="{{ route('costoCentros.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Costo Centros')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('costoCentros.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

