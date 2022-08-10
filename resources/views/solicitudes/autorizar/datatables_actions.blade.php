

@can('Ver requisición')
    <a href="#modal-detalles-{{$id}}" data-keyboard="true" data-toggle="modal" class='btn btn-secondary btn-xs' data-toggle="tooltip" title="Ver detalles">
        <i class="fa fa-eye"></i>
    </a>
@endcan

@if($solicitud->puedeEditar())
    @can('Editar requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-info btn-xs' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

