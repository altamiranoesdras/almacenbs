<div class="card border-info">
    <div class="card">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Ingreso Almacén</h5>
            <div class="heading-elements">
                <a data-bs-toggle="collapse" href="#collapseIngresoAlmacen" role="button" aria-expanded="{{ $abierta ?? false }}" aria-controls="collapseIngresoAlmacen">
                    <i data-feather="chevron-{{ ($abierta ?? false) ? 'up' : 'down' }}"></i>
                </a>
            </div>
        </div>

        <!-- Collapsible Content -->
        <div id="collapseIngresoAlmacen" class="collapse {{ ($abierta ?? false) ? 'show' : '' }}">

            <div class="col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center"
                           id="informacion-general-tab"
                           data-bs-toggle="tab"
                           href="#informacion-general"
                           role="tab"
                           aria-controls="informacion-general"
                           aria-selected="true">
                            <i data-feather="user" class="me-50"></i>
                            <span>Detalles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center"
                           id="bitacora-tab"
                           data-bs-toggle="tab"
                           href="#bitacora"
                           role="tab"
                           aria-controls="bitacora"
                           aria-selected="false">
                            <i data-feather="book" class="me-50"></i>
                            <span>Bitácora</span>
                        </a>
                    </li>
                </ul>
            </div>


            <div class="tab-content">
                <!-- TAB: Información General -->
                <div class="tab-pane fade show active"
                     id="informacion-general"
                     role="tabpanel"
                     aria-labelledby="informacion-general-tab">
                    <form action="{{ route('compras.actualizar.procesada', $compra->id) }}" method="post" class="esperar">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @include('compras.show_fields')
                                </div>
                                <div class="col-12 mb-2">
                                    @include('compras.tabla_detalles', ['detalles' => $compra->detalles])
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col">
                                    <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary round">
                                        <i class="fa fa-arrow-left"></i> Regresar
                                    </a>
                                </div>

                                <div class="col text-end">
                                    @if($compra->estaPendienteRecibir())
                                        <a href="{!! route('compras.ingreso',$compra->id) !!}" class="btn btn-success round ms-1">
                                            <i class="fa-solid fa-cart-flatbed"></i> Ingresar
                                        </a>
                                    @endif

                                    @can('Anular Ingreso de almacen')
                                        @if($compra->puedeAnular())
                                            <button type="button"
                                                    class="btn btn-outline-danger round ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalAnularaIngresoAlmacen"
                                                    title="Anular Ingreso">
                                                <i class="fa fa-undo-alt"></i> Anular Ingreso
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            </div>

                            @if($compra->puedeCancelar())
                                <div class="row mt-2">
                                    <div class="col-12 text-start">
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalCancelarIngresoAlmacen">
                                            <i class="fa fa-trash"></i> Eliminar ingreso a almacén
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- TAB: Bitácora -->
                <div class="tab-pane fade"
                     id="bitacora"
                     role="tabpanel"
                     aria-labelledby="bitacora-tab">
                    <div class="row">
                        <div class="col">
                            @include('layouts.partials.bitacoras', ['bitacoras' => $compra->bitacoras])
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>


</div>

@include('compras.partials.modal_cancelar_ingreso_almacen')
@include('compras.partials.modal_anular_ingreso_almacen')
