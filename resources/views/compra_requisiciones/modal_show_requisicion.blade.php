{{$compraRequisicion->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$compraRequisicion->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-uppercase">
                @include('compra_requisiciones.componentes.tarjeta_compra_requisicion', ['requisicion' => $compraRequisicion])
            </div>
            <div class="modal-footer" style="display: block !important;">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-target="#modalRegresar{{$compraRequisicion->id}}"
                        >
                            <i class="fa fa-arrow-left"></i> Regresar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalRegresar{{$compraRequisicion->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('solicitudes.aprobar.store',$compraRequisicion->id)}}" method="post" class="esperar">

                @csrf
                <div class="modal-body">

                    <div class="col-sm-12 mb-1">
                        {!! Form::label('motivo', 'Motivo de retorno:') !!}
                        {!! Form::textarea('motivo', null, ['class' => 'form-control','rows' => 3]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary round me-1" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" name="retornar" value="1" class="btn btn-outline-warning"
                            data-toggle="tooltip" title="Sí regresar">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
