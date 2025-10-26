<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr  class="text-center">
        <th>Insumo</th>
        <th>Categoría</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Unidad Solicita</th>
        <th>Fecha Vence</th>
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
            <td class="text-center">
                @if($det->item->categoria)
                    {{$det->item->categoria->nombre}}
                @else
                    <span class="badge bg-danger">Sin categoría</span>
                @endif
            </td>
            <td class="text-right">{{dvs().nfp($det->precio)}}</td>
            <td class="text-right">{{nf($det->cantidad)}}</td>
            <td class="text-right">{{$det->unidadSolicitante->nombre ?? 'sin unidad'}}</td>
            <td class="text-right">{{fechaLtn($det->fecha_vence)}}</td>
            <td class="text-right">{{dvs().nf($det->cantidad*$det->precio)}}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="6">Sub Total</th>
        <th class="text-right">
            {{dvs().nfp($compra->sub_total,2)}}
        </th>
    </tr>

    <tr>
        <th colspan="6">Descuento</th>
        <th class="text-right text-success">
            {{dvs().nf($compra->descuento)}}
        </th>
    </tr>

    <tr>
        <th colspan="6">Total</th>
        <th class="text-right">
            {{dvs().nf($compra->total)}}
        </th>
    </tr>
    </tfoot>
</table>
