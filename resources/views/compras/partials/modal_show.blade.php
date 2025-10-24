<div class="modal fade" id="modal-detalles-{{$compra->id}}" tabindex='-1'>
    <div class="modal-dialog modal-xl">
        <div class="modal-content " style="color: #0A0A0A">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del ingreso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="informacion-general-tab{{$compra->id}}"
                           data-bs-toggle="tab"
                           href="#informacion-general{{$compra->id}}"
                           role="tab"
                           aria-controls="informacion-general{{$compra->id}}"
                           aria-selected="true">
                            <i data-feather="user"></i> Detalles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="bitacora-tab{{$compra->id}}"
                           data-bs-toggle="tab"
                           href="#bitacora{{$compra->id}}"
                           role="tab"
                           aria-controls="bitacora{{$compra->id}}"
                           aria-selected="false">
                            <i data-feather="book"></i> Bitácora
                        </a>
                    </li>
                </ul>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active"
                             id="informacion-general{{$compra->id}}"
                             role="tabpanel"
                             aria-labelledby="informacion-general-tab{{$compra->id}}">
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
                             id="bitacora{{$compra->id}}"
                             role="tabpanel"
                             aria-labelledby="bitacora-tab{{$compra->id}}">
                            @include('layouts.partials.bitacoras', ['bitacoras' => $compra->bitacoras])
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($compra->estaPendienteRecibir())
                    <a href="{{route('compras.ingreso', $compra->id)}}">
                        <div class="btn btn-outline-success round">Ingresar</div>
                    </a>
                @endif

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
