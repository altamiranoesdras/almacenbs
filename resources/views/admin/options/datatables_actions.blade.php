@can('Ver opcion menu')
<a href="{{ route('dev.option.create', $id) }}" data-toggle="tooltip" title="Nueva" class='btn btn-icon btn-flat-success rounded-circle'>
    <i class="fa fa-plus"></i>
</a>
@endcan


@can('Editar opcion menu')
<a href="{{ route('dev.options.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('Eliminar opcion menu')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>
    <i class="fa fa-trash-alt"></i>
</a>


<form action="{{ route('dev.options.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan
