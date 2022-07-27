<table width="100%"  class="table table-bordered table-condensed" id="tablaDetalle">
    <thead>
    <tr class="bg-primary txtzs txtwb" align="center">
        <td width="50%">Producto</td>
        <td width="10%">Precio</td>
        {{--<td width="10%">Código</td>--}}
        <td width="10%">Cantidad</td>
        <td width="10%">Subtotal</td>
        <td width="10%">-</td>
    </tr>
    </thead>

    <tbody>
    @php
        $subt =0;
        $total =0;
    @endphp

    @if($detalles->count() > 0)
        @foreach($detalles as $det)
            @php
                $subt =$det->cantidad*$det->precio;
            @endphp
            <tr >
                <td class="celda-descripcion">{{$det->item->nombre}} {{ $det->item->marca ? ' / '.$det->item->marca->nombre : '' }}</td>
                <td class="celda-precio">{{ dvs() .' '.number_format($det->precio,2)}}</td>
                <td class="celda-cantidad">{{$det->cantidad}}</td>
                {{--<td class="celda-codigo">{{$det->item->codigo}}</td>--}}
                <td class="celda-subt">{{'dvs() '.number_format($subt,2)}}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-danger btnEliminaDet" data-loading-text="<i class='fa fa-cog fa-spin fa-1x fa-fw'></i>" value="{{$det->id}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <input type="hidden" name="cantidades[]" class="h-cantidad" value="{{$det->cantidad}}">
                    <input type="hidden" name="items[]" class="h-item" value="{{$det->item_id}}">
                    <input type="hidden" name="precios[]" class="h-precio" value="{{$det->precio}}">
                    {{--<input type="hidden" name="descuentos[]" class="h-descuento" value="{{$det->descuento}}">--}}
                    <input type="hidden" class="h-subt" value="{{$subt}}">
                </td>
            </tr>
        @endforeach
    @else
        <tr >
            <td class="celda-descripcion">-</td>
            <td class="celda-precio">0</td>
            <td class="celda-cantidad">0</td>
            {{--<td class="celda-codigo">0</td>--}}
            <td class="celda-subt">0</td>
            <td>
                <button type="button" class="btn btn-xs btn-danger btnEliminaDet" data-loading-text="<i class='fa fa-cog fa-spin fa-1x fa-fw'></i>" value="0" >
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <input type="hidden" name="cantidades[]" class="h-cantidad" value="" >
                <input type="hidden" name="items[]" class="h-item" value="">
                <input type="hidden" name="precios[]" class="h-precio" value="">
                {{--<input type="hidden" name="descuentos[]" class="h-descuento" value="">--}}
                <input type="hidden" class="h-subt" value="">
            </td>
        </tr>
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" >
            Total
            <span class="pull-right" id="totalTexto">{{ dvs() .' '.number_format($total,2)}}</span>
        </td>
    </tr>
    </tfoot>

</table>