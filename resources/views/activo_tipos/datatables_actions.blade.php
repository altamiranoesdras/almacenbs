@can('Ver Activo Tipos')
<a href="{{ route('activoTipos.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@can('Editar Activo Tipos')
<a href="{{ route('activoTipos.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('Eliminar Activo Tipos')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
    <i class="fa fa-trash-alt"></i>
</a>


<form action="{{ route('activoTipos.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan
