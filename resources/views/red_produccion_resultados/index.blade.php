@extends('layouts.app')

@section('titulo_pagina', 'Red Producción Resultados')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <h2 class="content-header-title mb-0">Red Producción Resultados</h2>
        </div>
{{--        <div class="content-header-right col-md-3 text-md-end col-12 d-md-block d-none">--}}
{{--            <a class="btn btn-success btn-sm" href="{{ route('red-produccion.resultados.create') }}">--}}
{{--                <i class="fa fa-plus"></i> Agregar Resultado--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>

{{--    <div class="content-body" id="root">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="accordion" id="accordionResultados">--}}
{{--                    @foreach(\App\Models\RedProduccionResultado::with('productos.subProductos')->get() as $item)--}}
{{--                        <div class="accordion-item mb-2 shadow-sm rounded">--}}
{{--                            <h2 class="accordion-header" id="heading-{{ $item->id }}">--}}
{{--                                <button class="accordion-button collapsed fw-bold text-primary" type="button" data-bs-toggle="collapse"--}}
{{--                                        data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false"--}}
{{--                                        aria-controls="collapse-{{ $item->id }}">--}}
{{--                                    <i class="fa fa-folder-open me-2"></i> Resultado: {{ $item->codigo }}--}}
{{--                                </button>--}}
{{--                            </h2>--}}
{{--                            <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse"--}}
{{--                                 aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordionResultados">--}}
{{--                                <div class="accordion-body">--}}
{{--                                    <div class="list-group mb-2">--}}
{{--                                        @foreach($item->productos as $producto)--}}
{{--                                            <div class="list-group-item">--}}
{{--                                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                    <div>--}}
{{--                                                        <i class="fa fa-cube text-success me-2"></i>--}}
{{--                                                        <strong>Producto:</strong> {{ $producto->codigo }}--}}
{{--                                                    </div>--}}
{{--                                                    <a href="#" class="btn btn-outline-primary btn-sm">--}}
{{--                                                        <i class="fa fa-plus"></i> Agregar SubProducto--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}

{{--                                                @if($producto->subProductos->count())--}}
{{--                                                    <ul class="list-group list-group-flush mt-2">--}}
{{--                                                        @foreach($producto->subProductos as $subProducto)--}}
{{--                                                            <li class="list-group-item">--}}
{{--                                                                <i class="fa fa-angle-right text-secondary me-2"></i>--}}
{{--                                                                <b>Subproducto:</b> {{ $subProducto->codigo }}--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}

{{--                                    <a href="#" class="btn btn-outline-primary btn-sm mt-2">--}}
{{--                                        <i class="fa fa-plus"></i> Agregar Producto--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--                <div class="mt-3 text-end">--}}
{{--                    <a href="#" class="btn btn-outline-success">--}}
{{--                        <i class="fa fa-plus"></i> Nuevo Resultado--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="content-body" id="app">
        <red-produccion-resultados/>
    </div>
@endsection

@push('scripts')
    <script>

        new Vue({
            el: '#app',
        });
    </script>
@endpush
