
{{--<a href="{{ route('compras.show', $id) }}" class='btn btn-info btn-xs' data-toggle="tooltip" title="Detalles">--}}

@can('ver detalles solicitud')
    <a href="#modal-detalles-{{$solicitud->id}}" data-keyboard="true" data-toggle="modal" class='btn btn-info btn-xs' data-toggle="tooltip" title="Ver detalles">
        <i class="fa fa-eye"></i>
    </a>
@endcan

@if($solicitud->estado->id !=\App\Models\SolicitudEstado::DESPACHADA)
    @can('eliminar solicitud')
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-outline-danger btn-xs'>
            <i class="fa fa-trash-alt"></i>
        </a>


        <form action="{{ route('solicitudes.destroy', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif

@if($solicitud->estado->id == \App\Models\SolicitudEstado::DESPACHADA )
    @can('anular solicitud')
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-outline-danger btn-xs'>
            <i class="fa fa-undo-alt"></i>
        </a>


        <form action="{{ route('solicitudes.destroy', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
