<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Insumo</th>
        <th>Categoría</th>
        <th>Tu Stock</th>
        <th>Cantidad Solicitada</th>
        <th>Cantidad Autorizada</th>
    </tr>
    </thead>
    <tbody>

    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <td class="text-center">
                @if($det->item->categoria)
                    {{$det->item->categoria->nombre}}
                @else
                    <span class="badge bg-danger">Sin categoría</span>
                @endif
            </td>
            <th>{{$det->item->stock_total}}</th>
            <td>{{$det->cantidad_solicitada}}</td>
            @if( $solicitud->estaAutorizada())
                <td> {{$det->cantidad_autorizada}}</td>
            @else
                <td>
                    <input type="number" name="cantidades_autoriza[]" step="any" class="form-control form-control-sm cantidades" required >
                </td>
            @endif
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
