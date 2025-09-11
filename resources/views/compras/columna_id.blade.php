{{$compra->id}}
<div class="modal fade" id="modal-detalles-{{$compra->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="informacion-general-tab"
                           data-bs-toggle="tab"
                           href="#informacion-general"
                           role="tab"
                           aria-controls="informacion-general"
                           aria-selected="true">
                            <i data-feather="user"></i> Detalles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="bitacora-tab"
                           data-bs-toggle="tab"
                           href="#bitacora"
                           role="tab"
                           aria-controls="bitacora"
                           aria-selected="false">
                            <i data-feather="book"></i> Bitácora
                        </a>
                    </li>
                </ul>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active"
                             id="informacion-general"
                             role="tabpanel"
                             aria-labelledby="informacion-general-tab">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-sm">
                                    @include('compras.show_fields',['compra'=>$compra])
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.tabla_detalles',['compra'=>$compra])
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade"
                             id="bitacora"
                             role="tabpanel"
                             aria-labelledby="bitacora-tab">
                            @include('layouts.partials.bitacoras', ['bitacoras' => $compra->bitacoras])
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($compra->estado_id == \App\Models\CompraEstado::PROCESADO_PENDIENTE_RECIBIR)
                    <a href="{{route('compras.ingreso', $compra->id)}}">
                        <div class="btn btn-outline-success round">Ingresar</div>
                    </a>
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


{{-- Modal para anular compra --}}
<div class="modal fade" id="modal-anular-{{$compra->id}}" tabindex='-1'>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" x-data="{ justificativa: '' }">
                        <form action="{{ route('compras.anular', $compra->id)}}" method="POST">
                            @method('POST')
                            {{ Form::textarea('justificativa_anulacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese motivo de anulación', 'rows' => 4, 'x-model' => 'justificativa', 'minlength' => 25]) }}
                            <span x-show="justificativa.length <= 25" style="color: red;">
                                La justificación debe tener al menos 25 caracteres. /
                                <b>
                                    <span x-text="justificativa.length" class="text-info"></span>
                                </b>
                            </span>
                            @csrf
                            {{-- lo habilita si justificativa_anulacion es mayor a 25 --}}
                            <template x-if="justificativa.length > 25">
                                <button type="submit"  class="btn btn-danger mt-2" >Anular Ingreso</button>
                            </template>

                            <template x-if="justificativa.length <= 25">
                                <div class="btn btn-danger disabled mt-2" >Anular Ingreso</div>
                            </template>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
