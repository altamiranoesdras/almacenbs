<table class="table table-bordered table-hover table-sm">
    <thead class="table-light">
    <tr>
        <th>Producto</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Aprobada</th>
        <th>Cantidad Despachada</th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{ $det->item->text }}</td>
            <td>{{ $det->cantidad_solicitada }}</td>
            <td>{{ $solicitud->muestraCantidadAprobar() ? $det->cantidad_autorizada : 'Pendiente' }}</td>
            <td>{{ $solicitud->muestraCantidadDespachar() ? $det->cantidad_despachada : 'Pendiente' }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4">
                <span class="float-end">
                    TOTAL Artículos:
                    {{ nf($solicitud->detalles->sum('cantidad_solicitada')) }}
                </span>
        </th>
    </tr>
    </tfoot>
</table>
