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

<h2 style="font-weight: bold; color: #0073e6; text-align: center; margin-bottom: 3px;">
    Secretaría de Bienestar Social
</h2>
<h5 style="text-align: center; margin-bottom: 35px; color: #0073e6;">
    de la Presidencia de la República
</h5>

<img src="{{ asset('img/logos/Logo_CGC_FT.png') }}" alt="Logo" style="width: 100px; position: absolute; right: 10px; top: 10px">

<h4 style="text-align: center; margin-bottom: 5px; font-weight: bold">
    REQUISICIÓN A ALMACÉN
</h4>
<h4 style="color: red; font-weight: bold; text-align: right; margin-bottom: 20px">
    No. {{ $solicitud->codigo }}
</h4>

<table style="width: 100%;">
    <tr style="width: 100%;">
        <td style="border: 1px solid black; width: 25%; background-color: {{ $color_tema }}; font-weight: bold; padding: 7px 3px 7px 3px ; font-size: {{ $size_texto_general }}">Fecha de Pedido:</td>
        <td style="font-size: {{ $size_texto_general }}; padding: 5px; border: 1px solid black; width: 25%">{{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y') }}</td>

        <td style="border: 1px solid black; width: 25%; background-color: {{ $color_tema }}; font-weight: bold; padding: 7px 3px 7px 3px ; font-size: {{ $size_texto_general }}">Fecha de Entrega de Pedido:</td>
        <td style="font-size: {{ $size_texto_general }}; padding: 5px; border: 1px solid black; width: 25%">{{ \Carbon\Carbon::parse($solicitud->fecha_despacha)->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td colspan="4" style="height: 20px;"></td>
    </tr>
    <tr>
        <td style="font-size: {{ $size_texto_general }};">Señor Guardalmacén:</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; width: 25%; background-color: {{ $color_tema }}; font-weight: bold; padding: 5px; font-size: {{ $size_texto_general }};">
            Sírvase entregar para:
        </td>
        <td colspan="3" style="border: 1px solid black; width: 75%; padding: 5px; font-size: {{ $size_texto_general }};">
            {{ $solicitud->usuarioSolicita->name ?? '' }}
        </td>
    </tr>
</table>

<br>

<table style="width: 100%; border-collapse: collapse; text-align: center;" border="0">
    <thead>
    <tr style="background-color: {{ $color_tema }}; font-weight: bold; border-top: 1px solid black; border-bottom: 1px solid black;">
        <th style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black; border-left: 1px solid black">Cantidad</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">Unidad de Medida</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">Descripción</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">Precio Unitario (Q)</th>
        <th style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">Precio Total (Q)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($solicitud->detalles as $detalle)
        <tr>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black; border-left: 1px solid black">{{ nf($detalle->cantidad_despachada, 0) }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; text-align: left; border-right: 1px solid black;">{{ $detalle->item->texto_requisicion }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">{{ dvs(). nf($detalle->precio ?? 0, 2) }}</td>
            <td style="font-size: {{ $size_texto_general }}; padding: 4px; border-right: 1px solid black;">{{ dvs(). nf(($detalle->precio ?? 0) * $detalle->cantidad_despachada, 2) }}</td>
        </tr>
    @endforeach

    @php
        $lineasRestantes = 15 - count($solicitud->detalles);
    @endphp
    @for ($i = 0; $i < $lineasRestantes; $i++)
        <tr>
            <td style="height: 25px; border-right: 1px solid black; border-left: 1px solid black"></td>
            <td style="border-right: 1px solid black;"></td>
            <td style="border-right: 1px solid black;"></td>
            <td style="border-right: 1px solid black;"></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>
    @endfor
    </tbody>
    <tfoot>
    <tr style="border: 1px solid black;">
        <td colspan="4" style="font-size: {{ $size_texto_general }}; text-align: right; font-weight: bold; padding: 4px; border-right: 1px solid black; background-color: {{ $color_tema }}">TOTAL Q.</td>
        <td style="font-weight: bold; padding: 4px; font-size: {{ $size_texto_general }};">
            {{dvs(). nf($solicitud->detalles->sum(fn($d) => ($d->precio ?? 0) * $d->cantidad_despachada), 2) }}
        </td>
    </tr>
    </tfoot>
</table>

<br>

<table style="width: 100%">
    <tr>
        <td style="width: 20%; background-color: {{ $color_tema }}; height: 50px; border: 1px solid black; font-size: {{ $size_texto_general }}; font-weight: bold">Observaciones:</td>
        <td style="width: 80%; height: 50px; border: 1px solid black"></td>
    </tr>
</table>

<br>

<table style="width: 100%; border-collapse: collapse; text-align: center;">
    <tr style="border: 1px solid black">
        <td colspan="3" style="text-align: center; font-weight: bold; padding: 4px; background-color: {{ $color_tema }}; font-size: {{ $size_texto_general }};">Nombres Firmas y Sellos</td>
    </tr>
    <tr style="height: 150px;">
        <td style="width: 33%; text-align: left; ">
            <div style="display: inline-block; width: 90%; height: 150px; border: 1px solid black;"></div>
        </td>
        <td style="width: 33%; text-align: center;" >
            <div style="display: inline-block; width: 90%; height: 150px; border: 1px solid black;"></div>
        </td>
        <td style="width: 33%; text-align: right;" >
            <div style="display: inline-block; width: 90%; height: 150px; border: 1px solid black;"></div>
        </td>
    </tr>
    <tr style="font-weight: bold;">
        <td style="width: 33%; text-align: left; ">
            <div style=" background-color: {{ $color_tema }}; display: inline-block; text-align: center; width: 90%; border: 1px solid black; font-size: {{ $size_texto_general }};">Solicitado por</div>
        </td>
        <td style="width: 33%; text-align: center;" >
            <div style=" background-color: {{ $color_tema }}; display: inline-block; text-align: center; width: 90%; border: 1px solid black; font-size: {{ $size_texto_general }};">Autorizado por</div>
        </td>
        <td style="width: 33%; text-align: right;" >
            <div style=" background-color: {{ $color_tema }}; display: inline-block; text-align: center; width: 90%; border: 1px solid black; font-size: {{ $size_texto_general }};">Recibido por</div>
        </td>
    </tr>
</table>

<br>

<div style="font-size: 9px;">
    AUTORIZADO POR LA CONTRALORIA GENERAL DE CUENTAS SEGUN RESOLUCION No. Fb./ 2662 CLAS.: 365-12-8-1-4-97 DE FECHA 01-04-1997. IMPRESO EN IMPRENTA GRAFICAS NIT: 233676-6 TEL.: 2254 7955
    2,500 UNIDADES DEL 63,501 AL 66,000 SIN SERIE ENVIO FISCAL 4-ASCC 20844 DE FECHA 10-02-2023 CORRELATIVO 38-2023 DE FECHA 10-02-2023 CUENTADANCIA 2022-100-101-18-076 LIBRO 4-ASCC FOLIO 45.
</div>
<div style="font-size: 10px; font-weight: bold; width: 100%; text-align: center">
    ORIGINAL: Encargado de Almacén - DUPLICADO: Unidad Solicitante - TRIPLICADO: Analista de Almacén
</div>
</body>
</html>
