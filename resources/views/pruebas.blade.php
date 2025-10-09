@extends('layouts.app')

@section('titulo_pagina',__('Pruebas'))

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Pruebas')}}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content-body">
        <div class="container-fluid">
            <div class="card" id="otroId">
                <pruebas></pruebas>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#otroId',
        });
    </script>
@endpush
