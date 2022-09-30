@can('Ver Activo Tarjetas')
<a href="{{ route('activoTarjetas.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-default btn-sm'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@can('Editar Activo Tarjetas')
<a href="{{ route('activoTarjetas.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-outline-info btn-sm'>
    <i class="fa fa-edit"></i>
</a>
@endcan

<a href="{{ route('activoTarjetas.pdf', $id) }}"  class='btn btn-outline-primary btn-sm' data-toggle="tooltip" title="PDF Tarjeta Responsabilidad" target="_blank">
    <i class="fa fa-file-pdf"></i>
</a>

@can('Eliminar Activo Tarjetas')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-outline-danger btn-sm'>
    <i class="fa fa-trash-alt"></i>
</a>


<form action="{{ route('activoTarjetas.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan

