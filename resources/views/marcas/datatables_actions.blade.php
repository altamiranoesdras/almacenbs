@can('Ver Marcas')
<a href="{{ route('marcas.show', $id) }}" data-bs-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@can('Editar Marcas')
<a href="{{ route('marcas.edit', $id) }}" data-bs-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('Eliminar Marcas')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-bs-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
    <i class="fa fa-trash-alt"></i>
</a>


<form action="{{ route('marcas.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan
