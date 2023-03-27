<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kardex insumo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

@php
    $i=0;
    $borde=0;
    $color ="white"
@endphp

<body style="width: 100%;">


    <table  style="width: 100%; margin-bottom: 2mm" border="{{$borde}} " >
        <tr style="height: 8mm; !important;">
            <td style="width: 33mm; text-align: left; vertical-align: middle; color: {{$color}}">Lugar y Fecha:</td>
            <td style="width: 160mm; text-align: left; vertical-align: middle;">{{ fechaLtnMesEnTexto($solicitud->fecha_despacha) }}</td>
        </tr>
    </table>
    <table  style="width: 100%; margin-bottom: 2mm" border="{{$borde}} " >
        <tr style="height: 8mm; !important;">
            <td style="width: 46mm; text-align: left; vertical-align: middle; color: {{$color}}">Unidad Solicitante:</td>
            <td style="width: 148mm; text-align: left; vertical-align: middle;"> {{$solicitud->unidad->nombre ?? ''}}</td>
        </tr>
    </table>
    <table  style="width: 100%; margin-bottom: 1mm" border="{{$borde}} " >
        <tr style="height: 8mm; !important;">
            <td style="width: 57mm; text-align: left; vertical-align: middle; color: {{$color}}">Nombre del Solicitante:</td>
            <td style="width: 139mm; text-align: left; vertical-align: middle;">{{ $solicitud->usuarioSolicita->name }}</td>
        </tr>
    </table>
    <table  style="width: 100%; margin-bottom: 8mm" border="{{$borde}} " >
        <tr style="height: 8mm; !important;">
            <td style="width: 17mm; text-align: left; vertical-align: middle; color: {{$color}}" >Cargo:</td>
            <td style="width: 174mm; text-align: left; vertical-align: middle;"><b>{{ $solicitud->usuarioSolicita->puesto->nombre ?? "Sin puesto" }}</b></td>
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

        @foreach ($solicitud->detalles as $detalle)
            <tr style="font-size: 12px; height: 6.5mm">
                <td style="">
                    {{ $detalle->item->texto_requisicion }}
                </td>
                <td style="">
{{--                    {{$detalle->item->presentacion->nombre ?? ''}} ---}}
                     {{ $detalle->item->unimed->nombre ?? '' }}
                </td>
                <td style="text-align: center">
                    {{ nf($detalle->cantidad_solicitada,0) }}
                </td>
                <td style="text-align: center">
                    {{ nf($detalle->cantidad_despachada,0) }}
                </td>
                <td style="text-align: center">
                    {{ nf($detalle->cantidad_despachada,0) }}
                </td>
            </tr>
            @php
                $totalLineas = 26;
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
