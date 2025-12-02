@php
    // 1. Configuración de TODOS los campos disponibles (Sin cambios aquí)
    $configuracionCampos = [
        'nombre' => ['label' => 'NOMBRE', 'accessor' => fn($d) => $d->item?->nombre],
        'cantidad' => ['label' => 'CANTIDAD', 'accessor' => fn($d) => number_format($d->cantidad ?? 0, 0)],
        'renglon' => ['label' => 'RENGLÓN', 'accessor' => fn($d) => $d->item?->renglon?->numero ?? 'Sin renglón'],
        'codigo_insumo' => ['label' => 'CÓDIGO DE INSUMO', 'accessor' => fn($d) => $d->item?->codigo_insumo],
        'descripcion' => ['label' => 'DESCRIPCIÓN', 'accessor' => fn($d) => $d->item?->descripcion],
        'presentacion_nombre' => ['label' => 'NOMBRE DE LA PRESENTACIÓN', 'accessor' => fn($d) => $d->item?->presentacion?->nombre ?? 'Sin presentación'],
        'unidad_medida' => ['label' => 'UNIDAD DE MEDIDA', 'accessor' => fn($d) => $d->item?->unimed?->nombre ?? 'Sin unidad'],
        'cod_presentacion' => ['label' => 'COD. PRESENTACIÓN', 'accessor' => fn($d) => $d->item?->codigo_presentacion],
        'monto_estimado' => ['label' => 'MONTO ESTIMADO', 'accessor' => fn($d, $Q) => "$Q " . number_format($d->precio_estimado ?? 0, 2), 'align' => 'text-end'],
        'subtotal' => ['label' => 'SubTotal', 'accessor' => fn($d, $Q) => "$Q " . number_format($d->sub_total ?? 0, 2), 'align' => 'text-end'],
    ];

    // 2. Lógica para determinar qué campos mostrar (Sin cambios aquí)
    $camposAMostrar = $campos ?? array_keys($configuracionCampos);

    $camposFiltrados = collect($configuracionCampos)->only($camposAMostrar)->toArray();
    $colspan = count($camposFiltrados); // Este es el número total de columnas

    // Variables de totales y valores predeterminados
    $detalles = $requisicion->detalles ?? collect();
    $Q = $Q ?? 'Q';
    $total = $detalles->sum('sub_total');
    $totalItems = $detalles->count();
@endphp

<div class="table-responsive mb-1">
    <table
        class="table table-bordered table-hover table-xtra-condensed"
        id="tablaDetalle" style="margin-bottom: 2px; width:100%;"
    >
        <thead class="small table-light">
        <tr class="text-center fw-bold">
            {{-- HEADER DINÁMICO --}}
            @foreach($camposFiltrados as $campo)
                <td>{{ $campo['label'] }}</td>
            @endforeach
        </tr>
        </thead>

        <tbody class="small">
        @if($detalles->isEmpty())
            <tr class="text-center">
                {{-- Colspan dinámico aquí --}}
                <td colspan="{{ $colspan }}">
                    <span class="text-muted">No se ha agregado ningún artículo</span>
                </td>
            </tr>
        @else
            @foreach($detalles as $detalle)
                <tr>
                    {{-- FILAS DE DATOS DINÁMICO --}}
                    @foreach($camposFiltrados as $campo)
                        @php
                            // ... Lógica de acceso ...
                            $valor = (in_array($campo['label'], ['MONTO ESTIMADO', 'SubTotal']))
                                ? $campo['accessor']($detalle, $Q)
                                : $campo['accessor']($detalle);

                            $claseAlineacion = $campo['align'] ?? '';
                        @endphp
                        <td class="{{ $claseAlineacion }}">{!! $valor !!}</td>
                    @endforeach
                </tr>
            @endforeach
        @endif
        </tbody>

        <tfoot class="small">
        <tr>
            {{-- FOOTER DINÁMICO - FILA TOTAL MONTO --}}
            <td colspan="{{ $colspan - 1 }}">
                <b class="float-end">Total monto</b>
            </td>
            <td class="text-end">
                <b>{{ $Q }} {{ number_format($total, 2) }}</b>
            </td>
        </tr>
        <tr>
            {{-- FOOTER DINÁMICO - FILA TOTAL INSUMOS --}}
            <td colspan="{{ $colspan - 1 }}">
                <b class="float-end">Total insumos</b>
            </td>
            <td class="text-end">
                <b>{{ number_format($totalItems, 0) }}</b>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
