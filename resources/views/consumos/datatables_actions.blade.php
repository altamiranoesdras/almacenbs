{{--@can('Ver Consumos')--}}
<a href="{{ route('consumos.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-outline-secondary rounded-circle'>
    <i class="fa fa-eye"></i>
</a>
{{--@endcan--}}

@if($consumo->puedeEditar())
{{--    @can('Editar Consumos')--}}
    <a href="{{ route('consumos.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-info rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
{{--    @endcan--}}
@endif

<!-- boton imprimir -->
@if($consumo->codigo)
{{--@can('Imprimir Consumos')--}}
    <a href="{{ route('consumos.pdf', $id) }}" data-toggle="tooltip" title="Imprimir" class='btn btn-outline-primary btn-sm' target="_blank">
        <i class="fa fa-print"></i>
    </a>
{{--@endcan--}}
@endif

@if($consumo->puedeAnular())

{{--    @can('Eliminar Consumos')--}}
    <a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Anular" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-ban"></i>
    </a>


    <form action="{{ route('consumos.anular', $id)}}" method="POST" id="delete-form{{$id}}">
        @method('POST')
        @csrf
    </form>
{{--    @endcan--}}
@endif
