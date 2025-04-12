<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Tu Stock</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Aprobada</th>
        <th>Cantidad despachada</th>

    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <th>{{$det->item->stock_total}}</th>
            <td>{{$det->cantidad_solicitada}}</td>
            <td> {{$det->cantidad_aprobada}}</td>
            @if( $solicitud->estaDespachada())
                <td> {{$det->cantidad_despachada}}</td>
            @else
            <td>
                <input type="number" name="cantidades_despacha[]" step="any" class="form-control form-control-sm" required >
            </td>
            @endif
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="5"><span class="pull-right">
                TOTAL Artículos
                {{nf($solicitud->detalles->sum('cantidad_solicitada'))}}
            </span>
        </th>
    </tr>
    </tfoot>
</table>
