<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Producto</th>
        @if(isset($despachar))
        <th>Tu Stock</th>
        @endif
        <th>Cantidad</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total=0;
    @endphp
    @foreach($solicitud->detalles as $det)
        <tr>
            <td>{{$det->item->nombre}}</td>
            @if(isset($despachar))
                <th>{{$det->item->stockTienda()}}</th>
            @endif
            <td>{{$det->cantidad}}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th colspan="5"><span class="pull-right">TOTAL Artículos {{nf($solicitud->detalles->sum('cantidad'))}}</span></th>
    </tr>
    </tfoot>
</table>
