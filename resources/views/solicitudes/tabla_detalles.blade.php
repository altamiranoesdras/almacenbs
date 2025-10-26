<table class="table table-bordered table-hover table-sm">
    <thead class="table-light">
    <tr>
        <th>Insumo</th>
        <th>Categoría</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Autorizada</th>
        <th>Cantidad Despachada</th>
    </tr>
    </thead>
    <tbody>
    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{ $det->item->text }}</td>
            <td class="text-center">
                @if($det->item->categoria)
                    {{$det->item->categoria->nombre}}
                @else
                    <span class="badge bg-danger">Sin categoría</span>
                @endif
            </td>
            <td>{{ $det->cantidad_solicitada }}</td>
            <td>{{ $solicitud->muestraCantidadAutorizada() ? $det->cantidad_autorizada : 'Pendiente' }}</td>
            <td>{{ $solicitud->muestraCantidadDespachar() ? $det->cantidad_despachada : 'Pendiente' }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5">
                <span class="float-end">
                    TOTAL Artículos:
                    {{ nf($solicitud->detalles->sum('cantidad_solicitada')) }}
                </span>
        </th>
    </tr>
    </tfoot>
</table>
