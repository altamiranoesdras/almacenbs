<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">Gastos</h3>

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
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gastos as $g)
                <tr>
                    <td>{{$g->descripcion}}</td>
                    <td>{{ dvs() }} {{nfp($g->monto,2)}}</td>
                </tr>
            @endforeach
            </tbody>
            <thead>
            <tr>
                <th>Total</th>
                <th>{{ dvs() }} {{nfp($gastos->sum('monto'),2)}}</th>
            </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
