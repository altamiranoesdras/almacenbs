<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr>
        <th>Insumo</th>
        <th>Cantidad</th>
    </tr>
    </thead>
    <tbody>

    @foreach($consumo->detalles as $det)
        <tr>
            <td>{{$det->item->text}}</td>
            <td>{{nf($det->cantidad)}}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <th>TOTAL Artículos</th>
        <th>
            <span class="pull-right">

                {{nf($consumo->detalles->sum('cantidad'))}}
            </span>
        </th>
    </tr>
    </tfoot>
</table>
