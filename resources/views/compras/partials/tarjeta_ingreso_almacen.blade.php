<div class="card border-info">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            Ingreso Almacén
        </h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li>
                    <a data-action="collapse">
                        <i data-feather="chevron-{{($abierta ?? false) ? 'up' : 'down'}}"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse {{($abierta ?? false) ? 'show' : 'hide'}}">
        <form action="{{route('compras.actualizar.procesada',$compra->id)}}" method="post">
            @csrf

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @include('compras.show_fields')
                </div>
                <div class="col-12 mb-2">
                    @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{!! route('compras.index') !!}"
                       class="btn round btn-outline-secondary mr-2 ">
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
                {{--                                <div class="col text-center">--}}
                {{--                                    <div type="submit" class="btn btn-outline-success round mx-auto">--}}
                {{--                                        <i class="fa fa-save "></i>--}}
                {{--                                        Actualizar--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                <div class="col text-end">
                    @if($compra->estaPendienteRecibir())
                        <a href="{!! route('compras.ingreso',$compra->id) !!}"
                           class="btn btn-success round ms-1">
                            <i class="fa-solid fa-cart-flatbed"></i>
                            Ingresar
                        </a>
                    @endif
                    @can('Anular Ingreso de almacen')
                        @if($compra->puedeAnular() )

                            <button type="button"
                                    data-toggle="tooltip" title="Anular Ingreso"
                                    class="btn round btn-outline-danger ms-1 "
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAnularaIngresoAlmacen">
                                Anular Ingreso <i class="fa fa-undo-alt"></i>
                            </button>
                        @endif
                    @endcan

                </div>

            </div>
            @if( $compra->puedeCancelar() )
                <div class="row mt-2">
                    <div class="col-12 mt-2 text-start">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCancelarIngresoAlmacen">
                            Cancelar ingreso almacén
                        </button>
                    </div>
                </div>
            @endif

        </div>
        </form>

    </div>
</div>

@include('compras.partials.modal_cancelar_ingreso_almacen')
@include('compras.partials.modal_anular_ingreso_almacen')
