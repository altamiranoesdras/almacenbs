@can('Ver Requisición')
    <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-detalles-{{ $solicitud->id }}"
        data-toggle="tooltip"
        title="Ver detalles"
        class='btn btn-icon btn-flat-info rounded-circle'
    >
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeImprimir())
    <a
        href="{{ route('solicitudes.despachoPdf', $id) }}"
        data-toggle="tooltip"
        title="Imprimir"
        target="_blank"
        class='btn btn-icon rounded-circle btn-flat-primary'
    >
        <i class="fa fa-file-pdf"></i>
    </a>
@endif

@if($solicitud->puedeAnular())
    @can('Anular Requisición')
        <a
            href="#" onclick="deleteItemDt(this)"
            data-id="{{$solicitud->id}}"
            data-toggle="tooltip"
            title="Anular"
            class='btn btn-icon btn-flat-secondary rounded-circle btn-flat-danger'
        >
            <i class="fa fa-undo-alt"></i>
        </a>

        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
