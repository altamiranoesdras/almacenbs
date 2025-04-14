@extends('layouts.app')

@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.select2')
@include('layouts.plugins.datatables_reportes')

@section('htmlheader_title')
    Comparar stock kardex, calculado y tabla
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Comparar stock kardex, calculado y tabla</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content-body">
        <div class="container-fluid">
            @include('layouts.partials.request_errors')


            <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-xtra-condensed" id="tbl-dets">
                                        <thead>
                                        <tr class="text-sm">
                                            <th>id</th>
                                            <th>Categoría</th>
                                            <th>Articulo</th>
                                            <th>U/M</th>
                                            <th>Stock Inicial</th>
                                            <th>Entradas</th>
                                            <th>Salidas</th>
                                            <th>Stock Kardex</th>
                                            <th>Stock Tabla</th>
                                            <th>Stock Calculado</th>
                                            <th>Diferencia</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($items as $det)
                                            <tr class="text-sm  ">
                                                <td>{{$det->id}}</td>
                                                <td>{{$det->categoria->nombre ?? ''}}</td>
                                                <td>{{$det->nombre}}</td>
                                                <td>{{$det->unimed->nombre ?? ''}}</td>
                                                <td>{{nf($det->getStockInicial())}}</td>
                                                <td>{{nf($det->getEntradasStock())}}</td>
                                                <td>{{nf($det->getSalidasStock())}}</td>
                                                <td>{{nf($det->getStockSegunKardex())}}</td>
                                                <td>{{nf($det->stockTienda())}}</td>
                                                <td>{{nf($det->getStockCalculado())}}</td>
                                                <td class="bg-{{colorComaraStocks($det->valorComparaStocks())}}">{{ textComparaStocks($det->valorComparaStocks())  }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('scripts')
    <!--    Scripts fields clientes
------------------------------------------------->
    <script>
        $(function () {

            var hoy=new Date();

//        var manana=new Date(hoy.getTime() + 24*60*60*1000);

            $("#fecha").datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: hoy
            });

            $('#tbl-dets').DataTable( {
                dom: 'Bfrtip',
                paginate: false,
                ordering: true,
                scrollY: '300px',
                language: {
                    "url": "{{asset('js/SpanishDataTables.json')}}"
                },
                buttons: [
                    {extend : 'copy', 'text' : '<i class="fa fa-copy"></i> <span class="d-none d-sm-inline">Copiar</span>'},
                    {extend : 'csv', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">CSV</span>'},
                    {extend : 'excel', 'text' : '<i class="fa fa-file-excel"></i> <span class="d-none d-sm-inline">Excel</span>'},
                    {extend : 'pdf', 'text' : '<i class="fa fa-file-pdf"></i> <span class="d-none d-sm-inline">PDF</span>'},
                    {extend : 'print', 'text' : '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'},
                ],
                "order": []
            } );

            $("#items").select2({
                placeholder: 'Seleccione uno...',
                language: "es",
                maximumSelectionLength: 1,
                allowClear: true
            });

        })
    </script>
@endpush
