@can('Ver Requisición')
    <button  type="button"
             class='btn btn-icon rounded-circle btn-outline-primary'
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
            class='btn btn-icon btn-outline-info rounded-circle'
            data-toggle="tooltip"
            title="Editar"
        >
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

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
            class='btn btn-icon rounded-circle btn-outline-danger'
        >
            <i class="fa fa-undo-alt"></i>
        </a>

        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
