@extends('layouts.app')

@section('htmlheader_title','Reporte Artículos Próximos A Vencer')

@section('content')
    <!-- Content Header (Page header) -->
    <x-content-header title="Reporte Artículos Próximos A Vencer">
        <a href="{{ route('home') }}" class="btn btn-default btn-sm">
            <i class="fa fa-home"></i> Inicio
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body">
        <div class="container-fluid">


            <div class="row">
                <div class="col">
                    <div class="card card-outline card-success">
                        <div class="card-header p-1">
                            <h3 class="card-title">Filtros</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">

                            {!! Form::open(['rout' => 'rpt.items.vencen','id' =>'form-filter-items-vencen']) !!}
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    {!! Form::label('cliente_id','Meses a validar: ') !!}
                                    {!!
                                        Form::select(
                                            'meses'
                                            ,[1 => '1 mes',2 =>'2 meses',3 =>'3 meses',4 =>'4 meses',5 =>'5 meses',6 =>'6 meses']
                                            , 1
                                            , ['id'=>'meses','class' => 'form-control',]
                                        )
                                    !!}
                                </div>

                                <div class="col-sm-4 mb-1">
                                    {!! Form::label('boton','&nbsp;') !!}
                                    <div>
                                        <button type="submit" id="boton" class="btn btn-info">
                                            <i class="fa fa-sync"></i> Filtrar
                                        </button>
                                    </div>
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                {!! $dataTable->table(['width' => '100%']) !!}
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection


@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function () {
            var dt = window.LaravelDataTables["dataTableBuilder"];

            //Cuando dibuja la tabla
            dt.on( 'draw.dt', function () {
                $(this).addClass('table-sm  table-bordered table-hover');
            });


            $('#form-filter-items-vencen').submit(function(e){

                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];

                table.draw();
            });

        })
    </script>
@endsection
