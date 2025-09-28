@can('Ver Requisición')
    <button  type="button"
             class="btn btn-secondary btn-xs"
             data-bs-toggle="modal"
             data-bs-target="#modal-detalles-{{ $id }}"
             title="Ver detalles">
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

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-icon btn-outline-info rounded-circle' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

