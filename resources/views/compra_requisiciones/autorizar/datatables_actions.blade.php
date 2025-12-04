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

<a href="{{ route('compra.requisiciones.autorizar.seguimiento', $id) }}" data-toggle="tooltip" title="Editar"
   class='btn btn-icon btn-outline-warning rounded-circle'>
    <i class="fa fa-edit"></i>
</a>


