@can('Ver Consumos')
<a href="{{ route('consumos.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-default btn-sm'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@if($consumo->puedeEditar())
    @can('Editar Consumos')
    <a href="{{ route('consumos.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-outline-info btn-sm'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan
@endif

@can('Eliminar Consumos')
<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Anular" class='btn btn-outline-danger btn-sm'>
    <i class="fa fa-ban"></i>
</a>


<form action="{{ route('consumos.anular', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('POST')
    @csrf
</form>
@endcan
