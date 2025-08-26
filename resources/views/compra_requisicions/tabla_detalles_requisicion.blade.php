@php
    $detalles = $compraRequisicion->detalles ?? collect();
    $Q = $Q ?? 'Q';
    $total = $detalles->sum('sub_total');
    $totalItems = $detalles->count();
@endphp

<div class="table-responsive mb-3">
    <table class="table table-bordered table-sm align-middle" id="tablaDetalle" style="margin-bottom: 2px; width:100%;">
        <thead class="small table-light">
        <tr class="text-center fw-bold">
            <td width="5%">CANTIDAD</td>
            <td width="5%">RENGLÓN</td>
            <td width="10%">CÓDIGO DE INSUMO</td>
            <td width="20%">NOMBRE</td>
            <td width="20%">DESCRIPCIÓN</td>
            <td width="10%">NOMBRE DE LA PRESENTACIÓN</td>
            <td width="10%">CANTIDAD Y UNIDAD DE MEDIDA</td>
            <td width="10%">COD. PRESENTACIÓN</td>
            <td width="10%">MONTO ESTIMADO</td>
            <td width="10%">SubTotal</td>
        </tr>
        </thead>

        <tbody class="small">
        @if($detalles->isEmpty())
            <tr class="text-center">
                <td colspan="11">
                    <span class="text-muted">No se ha agregado ningún artículo</span>
                </td>
            </tr>
        @else
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{ number_format($detalle->cantidad ?? 0, 0) }}</td>
                    <td>{{ $detalle->item?->renglon?->numero ?? 'Sin renglón' }}</td>
                    <td>{{ $detalle->item?->codigo_insumo }}</td>
                    <td>{{ $detalle->item?->nombre }}</td>
                    <td>{{ $detalle->item?->descripcion }}</td>
                    <td>{{ $detalle->item?->presentacion?->nombre ?? 'Sin presentación' }}</td>
                    <td>{{ $detalle->item?->unimed?->nombre ?? 'Sin unidad' }}</td>
                    <td>{{ $detalle->item?->codigo_presentacion }}</td>
                    <td class="text-end">{{ $Q }} {{ number_format($detalle->precio_estimado ?? 0, 2) }}</td>
                    <td class="text-end">{{ $Q }} {{ number_format($detalle->sub_total ?? 0, 2) }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>

        <tfoot class="small">
        <tr>
            <td colspan="10">
                <b class="float-end">Total monto</b>
            </td>
            <td class="text-end">
                <b>{{ $Q }} {{ number_format($total, 2) }}</b>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <b class="float-end">Total insumos</b>
            </td>
            <td class="text-end">
                <b>{{ number_format($totalItems, 0) }}</b>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
