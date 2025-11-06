<h5 class="mt-1">Egreso existencias</h5>
<table class="table table-bordered table-hover table-sm">
    <thead class="table-light">
    <tr>
        <th>Insumo</th>
        <th>Categoría</th>
        <th>Bodega</th>
        <th>Cantidad</th>
        <th>Precio Compra</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
     @php
        $total = 0;
        @endphp
    @foreach($solicitud->stockEgresos() as $transaccion)
        @php
            $total += $transaccion->sub_total;
        @endphp
        <tr>
            <td>{{ $transaccion->stock->item->text }}</td>
            <td class="text-center">
                @if($transaccion->stock->item->categoria)
                    {{$transaccion->stock->item->categoria->nombre}}
                @else
                    <span class="badge bg-danger">Sin categoría</span>
                @endif
            </td>
            <td>{{ $transaccion->stock->bodega->nombre }}</td>
            <td>{{ nf($transaccion->cantidad,0) }}</td>
            <td>{{ dvs().nfp($transaccion->stock->precio_compra) }}</td>
            <td>{{ dvs().nfp($transaccion->sub_total) }}</td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="8 " class="text-end">
            TOTAL: Q {{ nfp($total) }}
        </th>
    </tr>
    </tfoot>
</table>

{{--<h5 class="mt-1">Ingresos existencias</h5>--}}
{{--<table class="table table-bordered table-hover table-sm">--}}
{{--    <thead class="table-light">--}}
{{--    <tr>--}}
{{--        <th>Insumo</th>--}}
{{--        <th>Categoría</th>--}}
{{--        <th>Bodega</th>--}}
{{--        <th>Tipo transacción</th>--}}
{{--        <th>Cantidad</th>--}}
{{--        <th>Precio Compra</th>--}}
{{--        <th>Sub Total</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @php--}}
{{--        $total = 0;--}}
{{--    @endphp--}}
{{--    @foreach($solicitud->stockIngresos() as $transaccion)--}}
{{--        @php--}}
{{--            $total += $transaccion->stock->sub_total;--}}
{{--        @endphp--}}
{{--        <tr>--}}
{{--            <td>{{ $transaccion->stock->item->text }}</td>--}}
{{--            <td class="text-center">--}}
{{--                @if($transaccion->stock->item->categoria)--}}
{{--                    {{$transaccion->stock->item->categoria->nombre}}--}}
{{--                @else--}}
{{--                    <span class="badge bg-danger">Sin categoría</span>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--            <td>{{ $transaccion->stock->bodega->nombre }}</td>--}}
{{--            <td>{{ $transaccion->tipo }}</td>--}}
{{--            <td>{{ $transaccion->cantidad }}</td>--}}
{{--            <td>{{ $transaccion->stock->precio_compra }}</td>--}}
{{--            <td>{{ $transaccion->stock->sub_total }}</td>--}}

{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th colspan="8" class="text-end">--}}
{{--            TOTAL: Q {{ nfp($total) }}--}}
{{--        </th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
{{--</table>--}}
