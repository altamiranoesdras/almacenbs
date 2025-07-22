@can('Ver Requisición')
    <button  type="button"
             class='btn btn-icon rounded-circle btn-flat-primary'
             data-bs-toggle="modal"
             data-bs-target="#modal-detalles-{{ $id }}"
             title="Ver detalles"
             data-toggle="tooltip"
    >
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a
            href="{{ route('solicitudes.edit', $solicitud->id) }}"
            class='btn btn-icon btn-flat-info rounded-circle'
            data-toggle="tooltip"
            title="Editar"
        >
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

@if($solicitud->puedeAnular())
    <a
        href="{{ route('solicitudes.despachoPdf', $id) }}"
        class='btn btn-icon rounded-circle btn-flat-primary'
        data-toggle="tooltip"
        title="Imprimir"
        target="_blank"
    >
        <i class="fa fa-file-pdf"></i>
    </a>

    @can('Anular Requisición')
        <a
            href="#" onclick="deleteItemDt(this)"
            data-id="{{$solicitud->id}}"
            data-toggle="tooltip"
            title="Anular"
            class='btn btn-icon rounded-circle btn-flat-danger'
        >
            <i class="fa fa-undo-alt"></i>
        </a>

        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
