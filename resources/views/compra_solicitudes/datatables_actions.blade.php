@can('Ver Solicitud de Compra')
    <a href="{{ route('compra.solicitudes.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Solicitud de Compra')
    <a href="{{ route('compra.solicitudes.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Solicitud de Compra')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('compra.solicitudes.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

