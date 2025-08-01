@can('Ver Requisición')
    <button  type="button"
             class="btn btn-icon btn-outline-secondary rounded-circle"
             data-bs-toggle="modal"
             data-bs-target="#modal-detalles-{{ $id }}"
             title="Ver detalles">
        <i class="fa fa-eye"></i>
    </button>
@endcan

@if($solicitud->puedeImprimir())
{{--    <a href="{{ route('solicitudes.preimpreso', $id) }}"  class='btn btn-icon btn-outline-danger rounded-circle' data-toggle="tooltip" title="PDF de requision">--}}
{{--        <i class="fa fa-file-pdf"></i>--}}
{{--    </a>--}}

        <a href="{{ route('solicitudes.despachoPdf', $id) }}"  class='btn btn-icon btn-outline-primary rounded-circle' data-toggle="tooltip" title="Imprimir" target="_blank">
            <i class="fa fa-file-pdf"></i>
        </a>
@endif

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-icon btn-outline-info rounded-circle' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

@if($solicitud->puedeAnular())
    @can('Anular Requisición')
            <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-outline-danger rounded-circle'>
                <i class="fa fa-undo-alt"></i>
            </a>


            <form action="{{ route('solicitudes.destroy', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
                @method('DELETE')
                @csrf
            </form>
    @endcan
@endif
