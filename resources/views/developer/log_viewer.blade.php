@extends('layouts.app')

@section('titulo_pagina', 'LOGS')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <h1 class="m-0 text-dark">Prueba Apis</h1>--}}
{{--                </div><!-- /.col -->--}}
{{--            </div><!-- /.row -->--}}
        </div><!-- /.container-fluid -->
    </div>


    <div class="content" id="root">
        <div class="container-fluid">

        <iframe src="{{url('log-viewer/logs')}}" frameborder="0" width="100%" height="800"></iframe>

        </div>
    </div>

@endsection
