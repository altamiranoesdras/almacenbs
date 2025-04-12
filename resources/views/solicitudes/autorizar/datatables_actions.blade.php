

@can('Ver Requisición')
    <a href="#modal-detalles-{{$id}}" data-keyboard="true" data-toggle="modal" class='btn btn-secondary btn-xs' data-toggle="tooltip" title="Ver detalles">
        <i class="fa fa-eye"></i>
    </a>
@endcan

@if($solicitud->puedeEditar())
    @can('Editar Requisición')
        <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class='btn btn-icon btn-flat-info rounded-circle' data-toggle="tooltip" title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endcan
@endif

