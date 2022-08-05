<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">Ventas por categoría</h3>

        <div class="card-tools pull-right">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Categoría</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ventasPorCat as $r)
            <tr>
                <td>{{$r->nombre}}</td>
                <td>{{ dvs() }} {{nfp($r->total_ventas,2)}}</td>
            </tr>
            @endforeach
            </tbody>
            <thead>
            <tr>
                <th>Total</th>
                <th>{{ dvs() }} {{nfp($ventasPorCat->sum('total_ventas'),2)}}</th>
            </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
