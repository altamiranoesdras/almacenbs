

@can('Ver Requisición')
    <a href="#modal-detalles-{{$id}}" data-keyboard="true" data-toggle="modal" class='btn btn-secondary btn-xs' data-toggle="tooltip" title="Ver detalles">
        <i class="fa fa-eye"></i>
    </a>
@endcan


@if($solicitud->puedeImprimir())
    {{--    <a href="{{ route('solicitudes.preimpreso', $id) }}"  class='btn btn-icon btn-flat-danger rounded-circle' data-toggle="tooltip" title="PDF de requision">--}}
    {{--        <i class="fa fa-file-pdf"></i>--}}
    {{--    </a>--}}

    <a href="{{ route('solicitudes.despachoPdf', $id) }}"  class='btn btn-primary btn-xs' data-toggle="tooltip" title="Imprimir" target="_blank">
        <i class="fa fa-file-pdf"></i>
    </a>
@endif

@if($solicitud->puedeAnular())
    @can('Anular Requisición')
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$solicitud->id}}" data-toggle="tooltip" title="Anular" class='btn btn-outline-danger btn-xs'>
            <i class="fa fa-undo-alt"></i>
        </a>


        <form action="{{ route('solicitudes.anular', $solicitud->id)}}" method="POST" id="delete-form{{$solicitud->id}}">
            @method('POST')
            @csrf
        </form>
    @endcan
@endif
