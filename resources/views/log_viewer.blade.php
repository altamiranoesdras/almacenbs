@extends('layouts.app')

@section('titulo_pagina', 'LOGS')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        <h1>LOGS</h1>
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success float-end round"
                       href="{{ route('home') }}">
                        <i class="fa fa-home"></i>
                        Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="content-body">

        <iframe src="{{url('log-viewer/logs')}}" frameborder="0" width="100%" height="800"></iframe>

    </div>

@endsection
