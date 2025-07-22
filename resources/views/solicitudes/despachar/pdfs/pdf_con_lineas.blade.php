<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Requisición No. {{ $solicitud->codigo }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body style="margin: 0; padding: 0; font-size: 11px;">

<h3 style="font-weight: bold; color: #0073e6; text-align: center; margin-bottom: 5px;">
    Secretaría de Bienestar Social
</h3>
<h5 style="text-align: center; margin-bottom: 25px;">
    de la Presidencia de la República
</h5>
<h6 style="text-align: center; margin-bottom: 5px; font-weight: bold">
    REQUISICIÓN A ALMACÉN
</h6>
<h4 style="color: red; font-weight: bold; text-align: right; margin-bottom: 20px">
    No. {{ $solicitud->codigo }}
</h4>

<table style="width: 100%;">
    <tr style="width: 100%;">
        <td style="border: 1px solid black; width: 25%; background-color: #d8ecf7; font-weight: bold; padding: 5px">Fecha de Pedido:</td>
        <td style="border: 1px solid black; width: 25%">{{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y') }}</td>

        <td  style="border: 1px solid black; width: 25%; background-color: #d8ecf7; font-weight: bold; padding: 5px">Fecha de Entrega de Pedido:</td>
        <td style="border: 1px solid black; width: 25%">{{ \Carbon\Carbon::parse($solicitud->fecha_despacha)->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td colspan="4" style="height: 20px;"></td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Señor Guardalmacén:</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; width: 25%; background-color: #d8ecf7; font-weight: bold; padding: 5px">
            Sírvase entregar para:
        </td>
        <td colspan="3" style="border: 1px solid black; width: 75%; padding: 5px;">
            {{ $solicitud->destino ?? '' }}
        </td>
    </tr>
</table>

<br>

<table style="width: 100%; border-collapse: collapse; text-align: center;" border="1">
    <thead>
    <tr style="background-color: #d8ecf7; font-weight: bold;">
        <th style="padding: 4px;">Cantidad</th>
        <th style="padding: 4px;">Unidad de Medida</th>
        <th style="padding: 4px;">Descripción</th>
        <th style="padding: 4px;">Precio Unitario (Q)</th>
        <th style="padding: 4px;">Precio Total (Q)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($solicitud->detalles as $detalle)
        <tr>
            <td style="padding: 4px;">{{ nf($detalle->cantidad_solicitada, 0) }}</td>
            <td style="padding: 4px;">{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td style="padding: 4px; text-align: left;">{{ $detalle->item->texto_requisicion }}</td>
            <td style="padding: 4px;">{{ nf($detalle->precio_unitario ?? 0, 2) }}</td>
            <td style="padding: 4px;">{{ nf(($detalle->precio_unitario ?? 0) * $detalle->cantidad_solicitada, 2) }}</td>
        </tr>
    @endforeach

    @php
        $lineasRestantes = 10 - count($solicitud->detalles);
    @endphp
    @for ($i = 0; $i < $lineasRestantes; $i++)
        <tr>
            <td style="height: 25px;">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endfor
    </tbody>
    <tfoot>
    <tr>
        <td colspan="4" style="text-align: right; font-weight: bold; padding: 4px;">TOTAL Q.</td>
        <td style="font-weight: bold; padding: 4px;">
            {{ nf($solicitud->detalles->sum(fn($d) => ($d->precio_unitario ?? 0) * $d->cantidad_solicitada), 2) }}
        </td>
    </tr>
    </tfoot>
</table>

<br>

<table style="width: 100%">
    <tr>
        <td style="width: 20%; background: #d8ecf7; height: 50px; border: 1px solid black">Observaciones</td>
        <td style="width: 80%; height: 50px; border: 1px solid black"></td>
    </tr>
</table>

<br>

<table style="width: 100%; border-collapse: collapse; text-align: center;" border="1">
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold; padding: 4px; background-color: #d8ecf7;">Nombres Firmas y Sellos</td>
    </tr>
    <tr style="height: 50px;">
        <td style="vertical-align: bottom;">{{ $solicitud->usuarioSolicita->name }}</td>
        <td style="vertical-align: bottom;">{{ $solicitud->autorizado_por ?? '' }}</td>
        <td style="vertical-align: bottom;">{{ $solicitud->recibido_por ?? '' }}</td>
    </tr>
    <tr style="background-color: #d8ecf7; font-weight: bold;">
        <td>Solicitado por:</td>
        <td>Autorizado por:</td>
        <td>Recibido por:</td>
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
