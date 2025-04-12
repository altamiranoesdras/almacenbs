{{$solicitud->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$solicitud->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Requisición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>


            <form action="{{route('solicitudes.despachar.store',$solicitud->id)}}" method="post" class="esperar">

                @csrf

                <div class="modal-body text-uppercase">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-sm" style="font-size: 14px">
                            @include('solicitudes.show_fields',['solicitude'=>$solicitud])
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            @include('solicitudes.despachar.tabla_detalles',['solicitude'=>$solicitud])
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="display: block !important;">
                    <div class="row">
                        <div class="col-sm-6 text-left">


                            <!-- Button trigger modal -->
                            <span data-toggle="tooltip" title="Regresar para correción">

                                <button type="button" class="btn btn-outline-warning"  data-toggle="modal"
                                        data-target="#modalRegresar{{$solicitud->id}}">
                                    <i class="fa fa-arrow-left"></i> Regresar
                                </button>
                            </span>

                            <!-- Modal -->

                        </div>

                        <div class="col-sm-6 text-right">

                            {{--                    @if($solicitud->tieneStock())--}}
                            <button type="submit"   class="btn btn-outline-success">
                                <i class="fa fa-check"></i> Despachar
                            </button>
                            {{--                    @else--}}
                            {{--                        <div class="alert alert-danger" role="alert">--}}
                            {{--                            <strong>No tiene stock suficiente para despachar esta solicitud</strong>--}}
                            {{--                        </div>--}}
                            {{--                    @endif--}}
                        </div>


                    </div>


                </div>


            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalRegresar{{$solicitud->id}}" tabindex="-1" role="dialog"
     aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('solicitudes.despachar.store',$solicitud->id)}}" method="post" class="esperar">

                @csrf
                <div class="modal-body">

                    <div class="col-sm-12 mb-1">
                        {!! Form::label('motivo', 'Motivo de retorno:') !!}
                        {!! Form::textarea('motivo', null, ['class' => 'form-control','rows' => 3]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" name="retornar" value="1" class="btn btn-outline-warning" data-toggle="tooltip" title="Sí regresar">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
