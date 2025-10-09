@extends('layouts.app')

@section('titulo_pagina', 'Estructura Presupuestaria Programas')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        <h1>Estructura Presupuestaria Programas</h1>
                    </h2>
                </div>
            </div>
        </div>
    </div>



    <div class="content-body" id="appVue">
        <estructura-presupuestaria/>
    </div>

@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#appVue',
            mounted() {
                console.log('Instancia vue montada');
            },
            created() {
                console.log('Instancia vue creada');
            },
            data: {},
            methods: {
                getDatos() {
                    console.log('Metodo Get Datos');
                }
            }
        });
    </script>
@endpush
