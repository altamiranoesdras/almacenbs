@can('Ver Requisición')
    <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#modal-detalles-{{ $solicitud->id }}"
        data-toggle="tooltip"
        title="Ver detalles"
        class='btn btn-icon btn-outline-info rounded-circle'
    >
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeImprimir())
    <div class="col text-center">
        <div class="btn-group">
            <button type="button"
                    class="btn btn-outline-primary round dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <i class="fas fa-print"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('solicitudes.despachoPdf', $id) }}" target="_blank">
                        <i class="fas fa-file-pdf"></i> PreImpreso
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('solicitudes.despachoPdf.digital', $id) }}" target="_blank">
                        <i class="fas fa-file-alt"></i> Digital
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif

@if($solicitud->puedeAnular())
    @can('Anular Requisición')
        <a
            href="#" onclick="deleteItemDt(this)"
            data-id="{{$solicitud->id}}"
            data-toggle="tooltip"
            title="Anular"
            class='btn btn-icon btn-outline-secondary rounded-circle btn-outline-danger'
        >
            <i class="fa fa-undo-alt"></i>
        </a>

        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
