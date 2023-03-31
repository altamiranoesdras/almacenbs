<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Aprobada</th>
        <th>Cantidad despachada</th>
    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <td>{{$det->cantidad_solicitada}}</td>
            <td> {{$solicitud->estaAprobada() || $solicitud->estaDespachada() ? $det->cantidad_aprobada : "Pendiente"}}</td>
            <td> {{$solicitud->estaDespachada() ? $det->cantidad_despachada : "Pendiente"}}</td>
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
