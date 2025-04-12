<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Tu Stock</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Aprobada</th>
    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <th>{{$det->item->stock_total}}</th>
            <td>{{$det->cantidad_solicitada}}</td>
            @if( $solicitud->estaAprobada())
                <td> {{$det->cantidad_aprobada}}</td>
            @else
                <td>
                    <input type="number" name="cantidades_aprueba[]" step="any" class="form-control form-control-sm cantidades" required >
                </td>
            @endif
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th>
            TOTAL Artículos
        </th>
        <th colspan="5" class="text-right">
            {{nf($solicitud->detalles->sum('cantidad_solicitada'))}}
        </th>
    </tr>
    </tfoot>
</table>
