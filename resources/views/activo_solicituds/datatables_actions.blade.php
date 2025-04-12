@can('Ver Activo Solicitudes')
<a href="{{ route('activoSolicitudes.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-icon btn-flat-secondary rounded-circle'>
    <i class="fa fa-eye"></i>
</a>
@endcan

@can('Editar Activo Solicitudes')
<a href="{{ route('activoSolicitudes.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-icon btn-flat-info rounded-circle'>
    <i class="fa fa-edit"></i>
</a>
@endcan

@can('anular ingreso de solicitud activos')
    @if($activoSolicitud->estado_id != \App\Models\ActivoSolicitudEstado::ANULADA && $activoSolicitud->estado_id == \App\Models\ActivoSolicitudEstado::INGRESADA )
        <a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Anular Ingreso" class='btn btn-icon btn-flat-danger rounded-circle'>
            <i class="fa fa-undo-alt"></i>
        </a>

        <form action="{{ route('activoSolicitudes.anular', $id)}}" method="POST" id="delete-form{{$id}}">
            @method('POST')
            @csrf
        </form>
    @endif
@endcan

{{--@can('Eliminar Activo Solicitudes')--}}
{{--<a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-icon btn-flat-danger rounded-circle'>--}}
{{--    <i class="fa fa-trash-alt"></i>--}}
{{--</a>--}}


{{--<form action="{{ route('activoSolicitudes.destroy', $id)}}" method="POST" id="delete-form{{$id}}">--}}
{{--    @method('DELETE')--}}
{{--    @csrf--}}
{{--</form>--}}
{{--@endcan--}}
