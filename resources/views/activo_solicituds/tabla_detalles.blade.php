<table class="table table-bordered table-hover table-xtra-condensed">
    <thead>
    <tr  class="text-center">
        <th>Número de Bien</th>
        <th>Descripcion</th>
        <th>Tipo de Inventario</th>
        <th>Tipo de Solicitud</th>
        <th>Estado del Bien</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($activoSolicitud->detalles as $det)
        <tr >
            <td class="text-center">{{$det->activo->numero_documento}}</td>
            <td class="text-center">{{$det->activo->nombre}}</td>
            <td class="text-center">{{$det->activoTipo->text_corto}}</td>
            <td class="text-center">{{$det->activo->tipo_id}}</td>
            <td class="text-center">{{$det->estado_del_bien}}</td>
            <td class="text-center">{{$det->observaciones}}</td>
        </tr>
    @endforeach

    </tbody>
</table>
