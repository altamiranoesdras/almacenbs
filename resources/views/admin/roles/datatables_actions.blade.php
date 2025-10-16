@can('Ver Roles')
    <a href="{{ route('roles.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Roles')
    <a href="{{ route('roles.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Roles')
    <a href="#" onclick="deleteItemDt(this)" data-id="$id" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('roles.destroy', $id) }}" method="POST" id="delete-form$id">
        <input type="hidden" name="_method" value="DELETE">        <input type="hidden" name="_token" value="">    </form>
@endcan

