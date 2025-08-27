@can('Ver Compra Requisicions')
{{--    <a href="{{ route('compraRequisicions.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>--}}
{{--        <i class="fa fa-eye"></i>--}}
{{--    </a>--}}

<button
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#modal-detalles-{{ $compraRequisicion->id }}"
    data-toggle="tooltip"
    title="Ver detalles"
    class='btn btn-icon btn-outline-info rounded-circle'
>
    <i class="fa fa-eye"></i>
</button>
@endcan

@can('Editar Compra Requisicions')
{{--    <a href="{{ route('compraRequisicions.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>--}}
{{--        <i class="fa fa-edit"></i>--}}
{{--    </a>--}}
@endcan

@can('Eliminar Compra Requisicions')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('compra.requisiciones.requisicions.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

