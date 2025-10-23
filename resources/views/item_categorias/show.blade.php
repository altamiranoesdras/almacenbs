@extends('layouts.app')

@section('titulo_pagina', 'Categoría de insumos')

@section('content')

    <x-content-header titulo="Categoría de insumos">
        <a href="{{ route('itemCategorias.create') }}" class="btn btn-outline-success">
            <i class="fas fa-plus"></i> Nueva categoría
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <!-- Nombre -->
                        <h5 class="fw-bold mb-1">{{ __('Nombre:') }}</h5>
                        <p class="mb-3">{{ $itemCategoria->nombre }}</p>

                        <!-- Descripción -->
                        <h5 class="fw-bold mb-1">{{ __('Descripción:') }}</h5>
                        <p class="mb-4">{{ $itemCategoria->descripcion }}</p>

                        <h4 class="fw-bold border-bottom pb-2 mb-3">Folios Kardex</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle table-bordered">
                                <thead class="table-primary">
                                <tr>
                                    <th scope="col">Folio</th>
                                    <th scope="col">Insumo</th>
                                    <th scope="col">Líneas</th>
                                    <th scope="col" class="text-center">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($folios as $folio => $kardexs)
                                    <tr>
                                        <td>{{ $folio }}</td>
                                        <td>{{ $kardexs->first()->item->texto_kardex ?? 'N/A' }}</td>
                                        <td>{{ $kardexs->count() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('reportes.kardex') }}?item_id={{ $kardexs->first()->item->id }}&buscar=1"
                                               class="btn btn-sm btn-outline-primary"
                                               target="_blank">
                                                <i class="fas fa-eye"></i> Ver Kardex
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            No hay registros disponibles
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('itemCategorias.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Regresar') }}
                </a>
            </div>
        </div>


    </div>

@endsection

