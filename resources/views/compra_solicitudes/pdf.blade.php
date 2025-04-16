<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requisición {{$compraSolicitud->codigo}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

@php
    $i=0;
    $borde=1;
    $color ="black";
@endphp

<body style="width: 100%;">


<table  style="width: 100%; margin-bottom: 2mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 33mm; text-align: left; vertical-align: middle; color: {{$color}}">Lugar y Fecha:</td>
        <td style="width: 160mm; text-align: left; vertical-align: middle;">{{ fechaLtnMesEnTexto($compraSolicitud->fecha_requiere ?? hoyDb()) }}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 4mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 46mm; text-align: left; vertical-align: middle; color: {{$color}}">Unidad Solicitante:</td>
        <td style="width: 148mm; text-align: left; vertical-align: middle;"> {{$compraSolicitud->unidad->nombre ?? ''}}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 1mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 57mm; text-align: left; vertical-align: middle; color: {{$color}}">Nombre del Solicitante:</td>
        <td style="width: 139mm; text-align: left; vertical-align: middle;">{{ $compraSolicitud->usuarioSolicita->name }}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 9mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 17mm; text-align: left; vertical-align: middle; color: {{$color}}" >Cargo:</td>
        <td style="width: 174mm; text-align: left; vertical-align: middle;"><b>{{ $compraSolicitud->usuarioSolicita->puesto->nombre ?? "Sin puesto" }}</b></td>
    </tr>
</table>


<table  style="width: 100%; margin-bottom: 2mm;  " border="{{$borde}}; " >
    <tr style="color: {{$color}}">
        <td
            style="width: 75mm;
                    height: 10mm;
                vertical-align: middle;
                text-align: center;">
            Nombre del Producto
        </td>
        <td
            style="width: 26mm;
                    height: 10mm;
                vertical-align: middle;
                text-align: center">
            Unidad de Medida
        </td>
        <th
            style="width: 29mm;
                    height: 10mm;
                vertical-align: middle;
                text-align: center;
                font-weight: normal">
            Solicitada
        </th>
        <th style="width: 34mm;
                height: 10mm;
                vertical-align: middle;
                text-align: center;
                font-weight: normal" >
            DESPACHADA
        </th>
        <th style="width: 27mm;
                height: 10mm;
                vertical-align: middle;
                text-align: center;
                font-weight: normal" >
            Kardex
        </th>
    </tr>

    @foreach ($compraSolicitud->detalles as $detalle)
        @php
            $longitudTexto = strlen($detalle->item->texto_requisicion);
            $longitudMaxima = 64;
        @endphp
        <tr style="font-size: 12px; height: 6.5mm;line-height: {{$longitudTexto > $longitudMaxima ? '6.4mm' : 'auto'}}">
            <td style="width: 75mm;
                    vertical-align: middle;">
                {{ $detalle->item->texto_requisicion }}
            </td>
            <td style="vertical-align: top;">
                {{--                    {{$detalle->item->presentacion->nombre ?? ''}} ---}}
                {{ $detalle->item->unimed->nombre ?? '' }}
            </td>
            <td style="vertical-align: top;text-align: center">
                {{ nf($detalle->cantidad_solicitada,0) }}
            </td>
            <td style="vertical-align: top;text-align: center">
                {{ nf($detalle->cantidad_despachada,0) }}
            </td>
            <td style="vertical-align: top;text-align: center">

            </td>
        </tr>
        @php
            $totalLineas = 20;
            $final = $totalLineas - $loop->iteration;
        @endphp
    @endforeach

    @for ($i = 1; $i <= $final ; $i++)
        <tr style="font-size: 12px; height: 6.5mm">
            <td style="">

            </td>
            <td style="">

            </td>
            <td style="text-align: center">

            </td>
            <td style="text-align: center">

            </td>
            <td style="text-align: center">

            </td>
        </tr>
    @endfor
</table>


</body>

</html>
