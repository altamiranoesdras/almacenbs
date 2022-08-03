@extends('layouts.app')

@section('title_page')
	Despachar Requisiciones
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="m-0 text-dark">Despachar Requisiciones</h1>
                </div><!-- /.col -->
                {{--<div class="col">--}}
                    {{--<a class="btn btn-outline-success"--}}
                        {{--href="{!! route('solicitudes.create') !!}">--}}
                        {{--<i class="fa fa-plus"></i>--}}
                        {{--<span class="d-none d-sm-inline">Nueva Solicitud</span>--}}
                    {{--</a>--}}
                {{--</div><!-- /.col -->--}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           @include('solicitudes.table')
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

