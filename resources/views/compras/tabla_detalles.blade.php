<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr  class="text-center">
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Fecha V</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($compra->detalles as $det)
        <tr >
            <td>
                @if($det->item->deleted_at)
                    <del>
                        {{$det->item->text}}
                    </del>
                @else
                    {{$det->item->text}}
                @endif
            </td>
            <td class="text-right">{{dvs().nfp($det->precio)}}</td>
            <td class="text-right">{{nf($det->cantidad)}}</td>
            <td class="text-right">{{fecha($det->fecha_vence)}}</td>
            <td class="text-right">{{dvs().nf($det->cantidad*$det->precio)}}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="4">Sub Total</th>
        <th class="text-right">
            {{dvs().nfp($compra->sub_total,2)}}
        </th>
    </tr>

    <tr>
        <th colspan="4">Descuento</th>
        <th class="text-right text-success">
            {{dvs().nf($compra->descuento)}}
        </th>
    </tr>

    <tr>
        <th colspan="4">Total</th>
        <th class="text-right">
            {{dvs().nf($compra->total)}}
        </th>
    </tr>
    </tfoot>
</table>
