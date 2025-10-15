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
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-sm" style="font-size: 14px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="id">Id:</label>
                                    <div><strong>{{ $compraRequisicion->id }}</strong></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="codigo">Código:</label>
                                    <div><strong>{{ $compraRequisicion->codigo }}</strong></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="departamento">Departamento solicita:</label>
                                    <div><strong>{{ $compraRequisicion->unidad->nombre ?? '' }}</strong></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="fecha_solicita">Fecha Creación:</label>
                                    <div><strong>{{ fechaLtn($compraRequisicion->created_at) }}</strong></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-2">
                                    <label for="estado">Estado:</label><br>
                                    <span
                                        class="badge bg-info">{{ $compraRequisicion->estado->nombre }}</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 mt-3">
                        <label for="justificacion">Justificación:</label>
                        <div><strong>{{ $compraRequisicion->justificacion }}</strong></div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-1">
                <table class="table table-bordered table-hover table-xtra-condensed">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Solicitada</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($compraRequisicion->detalles as $det)
                        <tr>
                            <td>{{$det->item->text}}</td>
                            <td>{{$det->cantidad}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>
                            TOTAL Artículos
                        </th>
                        <th colspan="5" class="text-right">
                            {{$compraRequisicion->detalles->sum('cantidad')}}
                        </th>
                    </tr>
                    </tfoot>
                </table>
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
