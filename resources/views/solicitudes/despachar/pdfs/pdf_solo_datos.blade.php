<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Requisición No. {{ $solicitud->codigo }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
@php
    $color_tema = '#d8ecf7';
    $size_texto_general = '15px';
@endphp

<body style="margin: 0; padding: 0; font-size: 11px;">

<h2 style="font-weight: bold;  text-align: center; margin-bottom: 3px; color: #ffffff; ">
    Secretaría de Bienestar Social
</h2>
<h5 style="text-align: center; margin-bottom: 35px; color: #ffffff; ">
    de la Presidencia de la República
</h5>

{{--<img src="{{ asset('img/Logo_CGC_FT.png') }}" alt="Logo" style="width: 100px; position: absolute; right: 10px; top: 10px">--}}

<h4 style="text-align: center; margin-bottom: 5px; font-weight: bold;color: #ffffff; ">
    REQUISICIÓN A ALMACÉN
</h4>
<h4 style="font-weight: bold; text-align: right; margin-bottom: 20px;color: #ffffff; ">
    No. {{ $solicitud->codigo }}
</h4>

<table style="width: 100%;">
    <tr style="width: 100%;">
        <td style=" width: 25%;  font-weight: bold; padding: 7px 3px 7px 3px ; font-size: {{ $size_texto_general }} ;color: #ffffff; ">
            Fecha de Pedido:
        </td>
        <td style="font-size: {{ $size_texto_general }}; padding: 5px;  width: 25%">
            {{ fechaLtn($solicitud->fecha_solicita) }}
        </td>

        <td style=" width: 25%;  font-weight: bold; padding: 7px 3px 7px 3px ; font-size: {{ $size_texto_general }};color: #ffffff;  ">
            Fecha de Entrega de Pedido:
        </td>
        <td style="font-size: {{ $size_texto_general }}; padding: 5px;  width: 25%">
            {{ fechaLtn($solicitud->fecha_despacha) }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="height: 20px;"></td>
    </tr>
    <tr>
        <td style="font-size: {{ $size_texto_general }};color: #ffffff;">Señor Guardalmacén:</td>
    </tr>
    <tr>
        <td style=" width: 25%;  font-weight: bold; padding: 5px; font-size: {{ $size_texto_general }};color: #ffffff;">
            Sírvase entregar para:
        </td>
        <td colspan="3" style=" width: 75%; padding: 5px; font-size: {{ $size_texto_general }};">
            {{ $solicitud->usuarioSolicita->name ?? '' }}
        </td>
    </tr>
</table>

<br>
<br>
<br>

<table style="width: 100%; border-collapse: collapse; text-align: center;" border="0">
    <thead>
    <tr style=" font-weight: bold; color: #ffffff;">
        <th style="font-size: {{ $size_texto_general }}; padding: 4px;">Cantidad</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px;">Unidad de Medida</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px;">Descripción</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px;">Precio Unitario (Q)</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px;">Precio Total (Q)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($solicitud->detalles as $detalle)
        <tr>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px;">{{ nf($detalle->cantidad_despachada, 0) }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px;">{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; text-align: left; ">{{ $detalle->item->texto_requisicion }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; ">{{ dvs(). nf($detalle->precio ?? 0, 2) }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; ">{{ dvs(). nf(($detalle->precio ?? 0) * $detalle->cantidad_despachada, 2) }}</td>
        </tr>
    @endforeach

    @php
        $lineasRestantes = 17 - count($solicitud->detalles);
    @endphp
    @for ($i = 0; $i < $lineasRestantes - count($solicitud->detalles); $i++)
        <tr>
            <td style="height: 25px;"></td>
            <td style=""></td>
            <td style=""></td>
            <td style=""></td>
            <td style=""></td>
        </tr>
    @endfor

    <tr style="">
        <td colspan="4" style="font-size: {{ $size_texto_general }}; text-align: right; font-weight: bold; padding: 4px;color: #ffffff;">
            TOTAL Q.
        </td>
        <td style="font-weight: bold; padding: 4px; font-size: {{ $size_texto_general }};">
            {{dvs(). nf($solicitud->detalles->sum(fn($d) => ($d->precio ?? 0) * $d->cantidad_despachada), 2) }}
        </td>
    </tr>
    <tr style="">
        <td colspan="2" style="font-size: {{ $size_texto_general }}; text-align: right; font-weight: bold; padding: 4px;color: #ffffff;">
            Observaciones:
        </td>
        <td colspan="3" class="text-justify" style="height: 50px; padding: 4px; font-size: {{ $size_texto_general }};">
            {{  $solicitud->justificacion ?? '' }}
        </td>
    </tr>
    </tbody>
</table>



</body>
</html>
