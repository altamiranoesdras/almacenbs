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

@include('compra_requisiciones.componentes.boton_imprimir_pdf_firmado',['compraRequisicion' => $requisicion])

@if($requisicion->estado_id == \App\Models\CompraRequisicionEstado::CREADA)
    <a href="{{ route('compra.requisiciones.edit', $id) }}" data-toggle="tooltip" title="Editar"
       class='btn btn-icon btn-outline-warning rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@elseif($requisicion->estado_id == \App\Models\CompraRequisicionEstado::FUENTES_FINANCIAMIENTO_ASIGNADAS)
    <a href="{{ route('compra.requisiciones.requirente.seguimiento', $id) }}" data-toggle="tooltip" title="Editar"
       class='btn btn-icon btn-outline-warning rounded-circle'>
        <i class="fa fa-edit"></i>
    </a>
@endif


