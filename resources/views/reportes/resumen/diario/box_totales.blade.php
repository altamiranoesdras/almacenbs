<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title text-capitalize ">{{diaLetras($diaSemana)}} {{$dia}} de {{mesLetras($mes)}} de {{$anio}}</h3>

        <div class="card-tools pull-right">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Monto Apertura</th>
                    <th>Ventas Efectivo</th>
                    <th>Ventas Tarjeta</th>
                    <th>Pagos</th>
                    <th>Retiros</th>
                    <th>Monto Cierre</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cajas as $c)
                    @php

                    @endphp
                    <tr>
                        <td>{{$c->user->name}}</td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->monto_apertura)}}</td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->total_efectivo)}}</td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->total_tarjeta)}}</td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->total_pagos)}}</td>
                        <td>
                            <a class="pull-right" data-toggle="modal" href="#modalDetalleRetirosCaja{{$c->id}}">
                                -{{ dvs() }} {{nfp($c->total_retiros)}}
                            </a>
                            <div class="modal fade" id="modalDetalleRetirosCaja{{$c->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Retiros detalle</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @include('finanzas.cajas.table_retiros',['caja' => $c])
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->monto_cierre)}}</td>
                        <td class="text-right">{{ dvs() }} {{nfp($c->total)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="2" >Totales</th>
                    <th class="text-right">{{ dvs() }} {{nfp($cajas->sum('total_efectivo'))}}</th>
                    <th class="text-right">{{ dvs() }} {{nfp($cajas->sum('total_tarjeta'))}}</th>
                    <th class="text-right">{{ dvs() }} {{nfp($cajas->sum('total_pagos'))}}</th>
                    <th class="text-right">-{{ dvs() }} {{nfp($cajas->sum('total_retiros'))}}</th>
                    <th class="text-right">{{ dvs() }} {{nfp($cajas->sum('monto_cierre'))}}</th>
                    <th class="text-right">{{ dvs() }} {{nfp($cajas->sum('total'))}}</th>
                </tr>
                </tfoot>
            </table>
{{--            <a class="pull-right" data-toggle="modal" href="#cuadre-cash">Cuadrar caja</a>--}}
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
