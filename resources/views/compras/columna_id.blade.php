{{$compra->id}}


<div class="modal fade" id="modal-detalles-{{$compra->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-sm">
                        @include('compras.show_fields',['compra'=>$compra])
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        @include('compras.tabla_detalles',['compra'=>$compra])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($compra->estado_id == \App\Models\CompraEstado::CREADA)
                    <a href="{{route('compra.ingreso', $compra->id)}}" ><div class="btn btn-outline-success round" >Ingresar</div></a>
                @else
                    <h4><span class="badge badge-info">{{ $compra->estado->nombre}}</span></h4>
                @endif

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--modal para cancelar compra-->
<div class="modal fade" id="modal-delete-{{ $compra->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-delete-label">Cancelar Solicitud de Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de cancelar la solicitud de compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="{{ route('compras.destroy', $compra->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancelar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>
