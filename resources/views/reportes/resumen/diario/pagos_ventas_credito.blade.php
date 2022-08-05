<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">Pagos ventas credito</h3>

        <div class="card-tools pull-right">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if($vpagos->count() > 0 )
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>Venta</th>
                        <th>Monto</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vpagos as $pago)
                        <tr>
                            <td>{{$pago->venta->codigo}}</td>
                            <td>{{dvs().nfp($pago->monto)}}</td>
                            <td>
                                <a class="btn btn-sm btn-info" target="_blank" href="{{route('ventas.abonar',$pago->venta->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <th >Total</th>
                    <th>{{ dvs().nfp( $vpagos->sum('monto'))}} </th>
                    </tfoot>
                </table>
            </div>
        @else
            <h3 class="text-warning text-center">No hay registros</h3>
        @endif

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
