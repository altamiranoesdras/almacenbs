@extends('layouts.app')

@section('title_page')
	Editar Item Traslado
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Editar Item Traslado
                    </h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('itemTraslados.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">Listado</span>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            @include('adminlte-templates::common.errors')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                           {!! Form::model($itemTraslado, ['route' => ['itemTraslados.update', $itemTraslado->id], 'method' => 'patch','class' => 'esperar']) !!}
                                <div class="form-row">

                                    @include('item_traslados.fields')
                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        <button type="submit"  class="btn btn-outline-success">Guardar</button>
                                        <a href="{!! route('itemTraslados.index') !!}" class="btn btn-outline-default">Cancelar</a>
                                    </div>
                                </div>

                           {!! Form::close() !!}

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
