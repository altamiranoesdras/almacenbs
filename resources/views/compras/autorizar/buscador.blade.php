@extends('layouts.app')

@section('titulo_pagina', 'Buscador ingresos autorizador')

@include('layouts.plugins.select2')
@include('layouts.plugins.alpinejs')

@section('content')

    <x-content-header titulo="Buscador ingresos autorizador" >
{{--        <a class="btn btn-success float-right"--}}
{{--           href="{{ route('compras.create') }}">--}}
{{--            <i class="fa fa-plus"></i>--}}
{{--            Nueva Ingreso de Almacén--}}
{{--        </a>--}}
    </x-content-header>

    <div class="content-body">
        <div class="row">
            <div class="col">
                @include('compras.autorizar.filtros')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @include('compras.table')
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#formFiltersDatatables').submit(function(e){
                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];
                table.draw();
            });
        })

        vm = new Vue({
            el: '#root',
            mounted() {

            },
            created: function() {

            },
            data: {
                unidades: @json(\App\Models\RrhhUnidad::areas()->solicitan()->get()),
                unidadadSeleccionada: null
            },
            methods: {

            },
            computed: {

            },
            watch:{

            }
        });
    </script>
@endpush
