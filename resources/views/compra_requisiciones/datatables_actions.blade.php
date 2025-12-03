@can('Ver Compra Requisicions')
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

{{--@can('Editar Compra Requisicions')--}}
{{--    <a href="{{ route('compra.requisiciones.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-outline-warning rounded-circle'>--}}
{{--        <i class="fa fa-edit"></i>--}}
{{--    </a>--}}
{{--@endcan--}}

@include('compra_requisiciones.componentes.boton_imprimir_pdf_firmado', ['compraRequisicion' => $compraRequisicion])

@can('Eliminar Compra Requisicions')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('compra.requisiciones.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

