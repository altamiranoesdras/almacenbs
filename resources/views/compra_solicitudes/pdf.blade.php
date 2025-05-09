<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>REQUISICIÓN DE COMPRA</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
            text-align: center;
        }
        .no-border td {
            border: none;
            padding: 2px;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .left {
            text-align: left;
        }
        .underline {
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>

<!-- Encabezado institucional -->
<table class="no-border">
    <tr>
        <td style="width: 30%;">
            <img src="{{ getLogo('png',true) }}" width="100" alt="Logo">
        </td>
        <td style="width: 70%; text-align: center;">
            <div style="font-weight: bold;">REQUISICIÓN DE COMPRA</div>
            <div>FONDO ROTATIVO INTERNO</div>
        </td>
    </tr>
</table>

<!-- Datos generales -->
<table>
    <tr>
        <td style="width: 25%;">CÓDIGO CENTRO DE COSTO</td>
        <td style="width: 25%;">FECHA</td>
        <td style="width: 25%;">NIT</td>
        <td style="width: 25%;">CORRELATIVO</td>
    </tr>
    <tr>
        <td class="left">{{$compraSolicitud->usuarioSolicita->unidad->codigo}}</td>
        <td class="left">{{ fechaLtnMesEnTexto($compraSolicitud->fecha_requiere ?? hoyDb()) }}</td>
        <td class="left">337788-1</td>
        <td class="left">{{$compraSolicitud->codigo}}</td>
    </tr>
</table>

<!-- Unidad solicitante -->
<table>
    <tr>
        <td class="left" colspan="4">UNIDAD SOLICITANTE: {{ $compraSolicitud->unidad->nombre ?? '' }}</td>
    </tr>
</table>

<!-- Detalle de insumos -->
<table>
    <tr class="section-title">
        <td>CANTIDAD</td>
        <td>RENGLÓN</td>
        <td>CÓDIGO DE INSUMO</td>
        <td>NOMBRE</td>
        <td>DESCRIPCIÓN<br>(COLOR, TALLA, MATERIAL, ETC.)</td>
        <td>NOMBRE DE LA PRESENTACIÓN</td>
        <td>CANTIDAD Y UNIDAD DE MEDIDA</td>
        <td>COD. PRESENTACIÓN</td>
    </tr>

    @foreach ($compraSolicitud->detalles as $detalle)
        <tr>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td>{{ $detalle->item->codigo_insumo ?? '' }}</td>
            <td class="left">{{ $detalle->item->nombre ?? '' }}</td>
            <td class="left">{{ $detalle->item->descripcion ?? '' }}</td>
            <td>{{ $detalle->item->presentacion->nombre ?? '' }}</td>
            <td>{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td>{{ $detalle->item->codigo_presentacion ?? '' }}</td>
        </tr>
    @endforeach

    @for ($i = count($compraSolicitud->detalles); $i < 5; $i++)
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @endfor

    <tr>
        <td colspan="8" class="left">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . Última Línea . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</td>
    </tr>
</table>

<!-- Justificación -->
<table>
    <tr>
        <td class="left">JUSTIFICACIÓN DE LA COMPRA</td>
    </tr>
    <tr style="height: 60px;">
        <td class="left">
            {{$compraSolicitud->justificacion ?? ''}}
        </td>
    </tr>
</table>

<!-- Subproducto y partidas -->
<table>
    <tr class="section-title">
        <td style="width: 50%;">SUBPRODUCTO</td>
        <td style="width: 50%;">PARTIDAS PRESUPUESTARIAS</td>
    </tr>
    <tr>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->subproductos)[0]}}
        </td>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->partidas)[0]}}
        </td>
    </tr>
    <tr>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->subproductos)[1]}}
        </td>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->partidas)[1]}}
        </td>
    </tr>
    <tr>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->subproductos)[2]}}
        </td>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->partidas)[2]}}
        </td>
    </tr>
    <tr>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->subproductos)[3]}}
        </td>
        <td style="height: 20px;">
            {{explode('|',$compraSolicitud->partidas)[3]}}
        </td>
    </tr>
</table>

</body>
</html>
