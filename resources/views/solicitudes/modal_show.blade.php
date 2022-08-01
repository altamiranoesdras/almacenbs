{{$solicitud->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$solicitud->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-uppercase">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-sm" style="font-size: 14px">
                        @include('solicitudes.show_fields',['solicitude'=>$solicitud])
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @include('solicitudes.tabla_detalles',['solicitude'=>$solicitud])
                    </div>
                </div>

            </div>
            {{--Si existe la variable despachar y la solicitud no ha sido despachada--}}
            @if(isset($despachar) && $solicitud->estado_id!=\App\Models\SolicitudEstado::DESPACHADA)
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                    @if($solicitud->tieneStock())
                        <a href="{{route('solicitudes.despachar.store',$solicitud->id)}}"  class="btn btn-outline-success">Despachar</a>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <strong>No tiene stock suficiente para despachar esta solicitud</strong>
                        </div>
                    @endif
                </div>
            @endif
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
