

    <span data-toggle="tooltip" title="Ver detalles">
        <a href="#modal-detalles-{{$compra->id}}" data-keyboard="true" data-toggle="modal" class='btn btn-info btn-xs' >
            <i class="fa fa-eye"></i>
        </a>
    </span>

{{--    <a href="{{ route('compras.show', $compra->id) }}" class='btn btn-info btn-xs' data-toggle="tooltip" title="Ver Detalles">--}}
{{--        <i class="fa fa-eye"></i>--}}
{{--    </a>--}}

    <a href="{{ route('compras.edit', $compra->id) }}" class='btn btn-primary btn-xs' data-toggle="tooltip" title="Editar">
        <i class="fa fa-edit"></i>
    </a>



{{--     <a href="{{route('compra.pdf',$compra->id)}}" target="_blank" class='btn btn-outline-success btn-xs' data-toggle="tooltip" title="Imprimir Orden de Compra">--}}
{{--         <i class="fas fa-print"></i>--}}
{{--     </a>--}}

    @if($compra->tiene1h())
     <a href="{{route('compra.h1.pdf',$compra->id)}}" target="_blank" class='btn btn-outline-primary btn-xs' data-toggle="tooltip" title="Imprimir 1H">
         <i class="fas fa-print"></i>
     </a>
    @endif

    @can('Anular ingreso de compra')
        @if($compra->estado_id != \App\Models\CompraEstado::ANULADA && $compra->estado_id == \App\Models\CompraEstado::RECIBIDA )
            <a href="#" onclick="deleteItemDt(this)" data-id="{{$compra->id}}" data-toggle="tooltip" title="Anular Ingreso" class='btn btn-outline-danger btn-xs'>
                <i class="fa fa-undo-alt"></i>
            </a>


            <form action="{{ route('compras.anular', $compra->id)}}" method="POST" id="delete-form{{$compra->id}}">
                @method('POST')
                @csrf
            </form>
        @endif
        @if($compra->estado_id == \App\Models\CompraEstado::CREADA )
            {{--<a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-danger btn-xs'>--}}
                {{--<i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Solicitud de Compra"></i>--}}
            {{--</a>--}}
            <span data-toggle="tooltip" title="Cancelar Solicitud de Compra">
            <a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-warning btn-xs'>
                <i class="fas fa-ban" ></i>
            </a>
            </span>
        @endif
    @endcan



