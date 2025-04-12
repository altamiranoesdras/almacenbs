@can('Ver Permissions')
    <a href="{{ route('permissions.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Permissions')
    <a href="{{ route('permissions.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Permissions')
    <a href="#" onclick="deleteItemDt(this)" data-id="$id" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('permissions.destroy', $id) }}" method="POST" id="delete-form$id">
        <input type="hidden" name="_method" value="DELETE">        <input type="hidden" name="_token" value="">    </form>
@endcan

