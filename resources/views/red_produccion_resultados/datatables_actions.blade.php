@can('Ver Red Producción Resultados')
    <a href="{{ route('red-produccion.resultados.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Red Producción Resultados')
    <a href="{{ route('red-produccion.resultados.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Red Producción Resultados')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('red-produccion.resultados.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

