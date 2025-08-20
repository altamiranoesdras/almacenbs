@can('Ver Solicitud de Compra')
    <button
        data-toggle="tooltip"
        title="Ver"
        class='btn btn-icon btn-outline-info rounded-circle'>
        <i class="fa fa-eye"></i>
    </button>


@endcan

@can('Editar Solicitud de Compra')
    <a
        href="{{ route('compra.solicitudes.edit', $id) }}"
        data-toggle="tooltip"
        title="Editar"
        class='btn btn-icon btn-outline-warning rounded-circle'
    >
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

