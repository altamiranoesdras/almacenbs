@can('Ver Rrhh Puestos')
<a href="{{ route('rrhhPuestos.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@can('Editar Rrhh Puestos')
<a href="{{ route('rrhhPuestos.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('Eliminar Rrhh Puestos')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
    <i class="fa fa-trash-alt"></i>
</a>


<form action="{{ route('rrhhPuestos.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan
