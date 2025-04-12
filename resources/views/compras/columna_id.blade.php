{{$compra->id}}


<div class="modal fade" id="modal-detalles-{{$compra->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-sm">
                        @include('compras.show_fields',['compra'=>$compra])
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @include('compras.tabla_detalles',['compra'=>$compra])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($compra->estado_id == \App\Models\CompraEstado::CREADA)
                    <a href="{{route('compra.ingreso', $compra->id)}}" ><div class="btn btn-outline-success" >Ingresar</div></a>
                @else
                    <h4><span class="badge badge-info">{{ $compra->estado->nombre}}</span></h4>
                @endif

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
