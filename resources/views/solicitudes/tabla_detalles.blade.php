<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Producto</th>
        @if($solicitud->estaAprobada())
            <th>Tu Stock</th>
        @endif
        <th>Cantidad Solicitada</th>
        @if($solicitud->estaAprobada() || $solicitud->estaDespachada())
            <th>Cantidad despachada</th>
        @endif

    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->nombre}}</td>
            @if($solicitud->estaAprobada() )
                <th>{{$det->item->stock_total}}</th>
            @endif
            <td>{{$det->cantidad_solicitada}}</td>
            @if($solicitud->estaAprobada() || $solicitud->estaDespachada())
                @if( $solicitud->estaDespachada())
                    <td> {{$det->cantidad_despachada}}</td>
                @else
                <td>
                    <input type="number" name="cantidades[]" step="any" class="form-control form-control-sm" required >
                </td>
                @endif
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
