{{$solicitud->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$solicitud->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Requisición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

                @if($solicitud->puedeAprobar())

                    <form action="{{route('solicitudes.aprobar.store',$solicitud->id)}}" method="post" class="esperar">
                        @endif
                @if($solicitud->puedeDespachar())
                    <form action="{{route('solicitudes.despachar.store',$solicitud->id)}}" method="post" class="esperar">
                @endif

                @csrf

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


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

{{--                    @can("Autorizar Requisición")--}}
{{--                        @if($solicitud->puedeAutorizar())--}}
{{--                            <a href="{{route('solicitudes.autorizar.store',$solicitud->id)}}"  class="btn btn-outline-success">--}}
{{--                                Autorizar--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    @endcan--}}

                    @can("Aprobar Requisición")
                        @if($solicitud->puedeAprobar())
                            <button type="submit"   class="btn btn-outline-success">
                                Aprobar
                            </button>
                        @endif
                    @endcan

                    @can("Despachar Requisición")
                        @if($solicitud->puedeDespachar())
                            @if($solicitud->tieneStock())
                                <button type="submit"   class="btn btn-outline-success">
                                    Despachar
                                </button>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    <strong>No tiene stock suficiente para despachar esta solicitud</strong>
                                </div>
                            @endif
                        @endif
                    @endcan

                </div>

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
