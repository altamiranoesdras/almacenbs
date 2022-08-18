

@can('Ver requisición')
    <a href="#modal-detalles-{{$id}}" data-keyboard="true" data-toggle="modal" class='btn btn-secondary btn-xs' data-toggle="tooltip" title="Ver detalles">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('solicitudes.preimpreso', $id) }}"  class='btn btn-danger btn-xs' data-toggle="tooltip" title="PDF de requision" target="_blank">
        <i class="fa fa-file-pdf"></i>
    </a>

@endcan

@if($solicitud->puedeEditar())
    @can('Editar requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-info btn-xs' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

@if($solicitud->puedeAnular())


    <a href="{{ route('solicitudes.despachoPdf', $id) }}"  class='btn btn-primary btn-xs' data-toggle="tooltip" title="PDF de Despacho" target="_blank">
        <i class="fa fa-file-pdf"></i>
    </a>

    @can('Anular requisición')
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Anular" class='btn btn-outline-danger btn-xs'>
            <i class="fa fa-undo-alt"></i>
        </a>


        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
