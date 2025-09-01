<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr  class="text-center">
        <th>id</th>
        <th>Cantidad</th>
        <th>Descripción Articulo</th>
        <th>U/M</th>
        <th>Renglón</th>
        {{-- <th>F/ALM</th> --}}
        <th>P/U</th>
        <th>S-Total</th>
        {{-- <th>F/INV</th> --}}
        {{-- <th>INV</th> --}}
    </tr>
    </thead>
    <tbody>
    @foreach($compra->compra1h->detalles as $det)
        <tr >
            <td>{{nf($det->item->id)}}</td>
            <td>{{nf($det->cantidad)}}</td>
            <td>
                {{$det->item->texto_principal}}
{{--                @if($det->item->esGrupo300())--}}
                <input type="text"
                       class="form-control form-control-sm"
                       placeholder="Series o descripción adicional"
                       name="textos_extras[{{$det->id}}]"
                       value="{{$det->texto_extra ?? ''}}"
                >
{{--                @endif--}}
            </td>
            <td>{{$det->item->unimed->nombre ?? ''}}</td>
            <td>{{$det->item->renglon->numero ?? ''}}</td>
            {{-- <td>
                <input type="number"
                       class="form-control form-control-sm"
                       name="folios_almacen[{{$det->id}}]"
                       value="{{$det->folio_almacen ?? $compra->folio_almacen ?? ''}}">

            </td> --}}
            <td class="text-right">{{dvs().nfp($det->precio)}}</td>
            <td class="text-right">{{dvs().nfp($det->cantidad*$det->precio,2)}}</td>
            {{-- <td>
                <input type="number"
                       class="form-control form-control-sm"
                       name="folios_inventario[{{$det->id}}]"
                       value="{{$det->folio_inventario ?? $compra->folio_inventario ?? ''}}">
            </td> --}}
            {{-- <td>
                <input type="text"
                       class="form-control form-control-sm"
                       name="codigos_inventario[{{$det->id}}]"
                       value="{{$det->codigo_inventario ?? ''}}">
            </td> --}}
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="6">Sub Total</th>
        <th class="text-right">
            {{dvs().nf($compra->sub_total)}}
        </th>
        {{-- <th></th> --}}
        {{-- <th></th> --}}
    </tr>

    <tr>
        <th colspan="6">Descuento</th>
        <th class="text-right text-success">
            {{dvs().nf($compra->descuento)}}
        </th>
        {{-- <th></th> --}}
        {{-- <th></th> --}}
    </tr>

    <tr>
        <th colspan="6">Total</th>
        <th class="text-right">
            {{dvs().nf($compra->total)}}
        </th>
        {{-- <th></th> --}}
        {{-- <th></th> --}}
    </tr>
    </tfoot>
</table>
