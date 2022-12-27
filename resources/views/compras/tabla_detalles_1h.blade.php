<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr  class="text-center">
        <th>Cantidad</th>
        <th>Descripción Articulo</th>
        <th>U/M</th>
        <th>Renglón</th>
        <th>F/ALM</th>
        <th>P/U</th>
        <th>S-Total</th>
        <th>F/INV</th>
        <th>INV</th>
    </tr>
    </thead>
    <tbody>
    @foreach($compra->compra1h->detalles as $det)
        <tr >
            <td>{{nf($det->cantidad)}}</td>
            <td>{{$det->item->nombre}}</td>
            <td>{{$det->item->unimed->nombre}}</td>
            <td>{{$det->item->renglon->numero}}</td>
            <td>{{$compra->folio_almacen ?? ''}}</td>
            <td class="text-right">{{dvs().nf($det->precio)}}</td>
            <td class="text-right">{{dvs().nf($det->cantidad*$det->precio)}}</td>
            <td>{{$det->folio_inventario}}</td>
            <td></td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="8">Sub Total</th>
        <th class="text-right">
            {{dvs().nf($compra->sub_total)}}
        </th>
    </tr>

{{--    <tr>--}}
{{--        <th colspan="4">Descuento</th>--}}
{{--        <th class="text-right text-success">--}}
{{--            {{dvs().nf($compra->descuento_monto)}}--}}
{{--        </th>--}}
{{--    </tr>--}}

    <tr>
        <th colspan="8">Total</th>
        <th class="text-right">
            {{dvs().nf($compra->total)}}
        </th>
    </tr>
    </tfoot>
</table>
