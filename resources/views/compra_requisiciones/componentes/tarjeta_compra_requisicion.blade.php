<div class="card border-info">
    <div class="card">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Detalles Requisición Compra</h5>
            <div class="heading-elements">
                <a data-bs-toggle="collapse" href="#collapseIngresoAlmacen" role="button"
                   aria-expanded="{{ $abierta ?? false }}" aria-controls="collapseIngresoAlmacen">
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
                     aria-labelledby="informacion-general-tab"
                >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @include('compra_requisiciones.componentes.show_fields')
                                @include('compra_requisiciones.componentes.tabla_detalles_requisicion', ['campos' => $camposDeTabla ?? null])
                            </div>
                        </div>
                    </div>

                </div>

                <!-- TAB: Bitácora -->
                <div class="tab-pane fade"
                     id="bitacora"
                     role="tabpanel"
                     aria-labelledby="bitacora-tab">
                    <div class="row">
                        <div class="col">
                            @include('layouts.partials.bitacoras', ['bitacoras' => $requisicion->bitacoras])
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
