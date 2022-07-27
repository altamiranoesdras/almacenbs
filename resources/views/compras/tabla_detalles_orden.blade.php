<table border="1" width="85%">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
    </tr>
    </thead>
    <tbody>

    @foreach($compra->compraDetalles as $det)
        <tr>
            <td>{{$det->item->nombre}}</td>
            <td>{{nf($det->cantidad)}}</td>
        </tr>

    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="5" align="right">Total Artículos  {{nf( $compra->compraDetalles->sum('cantidad') )}}</th>
    </tr>
    </tfoot>
</table>
