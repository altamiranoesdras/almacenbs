@can('Ver Requisición')
    <button type="button"
            class='btn btn-icon rounded-circle btn-outline-secondary'
            data-bs-toggle="modal"
            data-bs-target="#modal-detalles-{{ $id }}"
            title="Ver detalles">
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeImprimir())
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
@endif

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-icon btn-outline-info rounded-circle'
           data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

{{--@if($solicitud->puedeAnular())--}}
{{--    @can('Anular Requisición')--}}
{{--        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Eliminar"--}}
{{--           class='btn btn-icon btn-outline-danger rounded-circle'>--}}
{{--            <i class="fa fa-undo-alt"></i>--}}
{{--        </a>--}}


{{--        <form action="{{ route('solicitudes.destroy', $solicitud->id)}}" method="POST"--}}
{{--              id="delete-form{{$solicitud->id}}">--}}
{{--            @method('DELETE')--}}
{{--            @csrf--}}
{{--        </form>--}}
{{--    @endcan--}}
{{--@endif--}}
