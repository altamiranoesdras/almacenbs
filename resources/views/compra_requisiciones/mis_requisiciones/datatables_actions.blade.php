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

    @if($compraRequisicion->puedeEditar())
        <a href="{{ route('compra.requisiciones.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-warning rounded-circle'>
            <i class="fa fa-edit"></i>
        </a>
    @endif



