@can('Ver Rrhh Unidads')
<a href="{{ route('rrhhUnidades.show', $id) }}" data-toggle="tooltip" title="Nueva" class='btn btn-icon btn-flat-success rounded-circle'>
    <i class="fa fa-plus"></i>
</a>
@endcan


@can('Editar Rrhh Unidads')
<a href="{{ route('rrhhUnidades.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('Eliminar Rrhh Unidads')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('rrhhUnidades.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
        @method('DELETE')
        @csrf
    </form>
@endcan
