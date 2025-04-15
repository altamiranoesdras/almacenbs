@can('Ver Compra Solicitud Estados')
    <a href="{{ route('compraSolicitudEstados.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Compra Solicitud Estados')
    <a href="{{ route('compraSolicitudEstados.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Compra Solicitud Estados')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('compraSolicitudEstados.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

