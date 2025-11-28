<button
    type="button"
    data-bs-toggle="modal"
    data-bs-target="#modal-detalles-{{ $requisicion->id }}"
    data-toggle="tooltip"
    title="Ver detalles"
    class='btn btn-icon btn-outline-info rounded-circle'
>
    <i class="fa fa-eye"></i>
</button>

<a href="{{ route('compra.requisiciones.analista.compras.seguimiento', $id) }}" data-toggle="tooltip" title="Editar"
   class='btn btn-icon btn-outline-warning rounded-circle'>
    <i class="fa fa-edit"></i>
</a>

@can('Anular Compra Requisiciones')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar"
       class='btn btn-icon btn-outline-danger rounded-circle'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('compra.requisiciones.destroy', $id) }}" method="POST"
          id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

