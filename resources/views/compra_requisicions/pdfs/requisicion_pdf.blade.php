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
        <td style="width: 100%; padding: 0;">
            <div style="display: table; width: 100%; border-collapse: collapse;">
                <div style="display: table-cell; width: 30%; vertical-align: middle;">
                    <img src="{{ asset('img/logos/Logo_Secretaria_BS.png') }}" alt="Logo" style="width: 100%;">
                </div>
                <div style="display: table-cell; width: 70%; text-align: center; vertical-align: middle;">
                    <h2 style="font-weight: bold;">REQUISICIÓN DE COMPRA</h2>
                    <h3>PEDIDO</h3>
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- Datos generales -->
<table style="width: 100%; text-align: center; margin-top: 10px" class="no-border">
    <tr style="font-weight: bold;">
        <td style="width: 25%; text-align: left; ">
            <div style=" display: inline-block; text-align: center;">CÓDIGO CENTRO DE COSTO</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style=" display: inline-block; text-align: center;">FECHA</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style=" display: inline-block; text-align: center;">NIT</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style=" display: inline-block; text-align: center;">CORRELATIVO DEPTO. DE COMPRAS</div>
        </td>
    </tr>
    <tr style="height: 40px;">
        <td style="width: 25%; text-align: center; ">
            <div style="display: inline-block; width: 80%; border: 1px solid black; padding: 10px; font-weight: bold; font-size: 12px">{{$requisicion->usuarioSolicita->unidad->codigo ?? 'Sin unidad'}}</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style="display: inline-block; width: 80%; border: 1px solid black; padding: 10px; font-weight: bold; font-size: 12px">{{fechaLtnMesEnTexto($requisicion->fecha_requiere ?? hoyDb())}}</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style="display: inline-block; width: 80%; border: 1px solid black; padding: 10px; font-weight: bold; font-size: 12px">337788-1</div>
        </td>
        <td style="width: 25%; text-align: center;" >
            <div style="display: inline-block; width: 80%; border: 1px solid black; padding: 10px; font-weight: bold; font-size: 12px">{{$requisicion->codigo}}</div>
        </td>
    </tr>
</table>

<!-- Unidad solicitante -->
<table style="margin-top: 15px; width: 100%">
    <tr>
        <td class="left" colspan="4" style="border: none">UNIDAD SOLICITANTE:</td>
    </tr>
    <tr>
        <td class="left" colspan="4" style="text-align: center;">
            <h3>{{ $requisicion->unidad->nombre ?? '' }}</h3>
        </td>
    </tr>
</table>

<!-- Detalle de insumos -->
<table>
    <tr class="section-title">
        <td>COD INSUMO</td>
        <td>COD. PRESENTACIÓN</td>
        <td>RENGLÓN</td>
        <td>UNIDAD DE MEDIDA</td>
        <td>CANTIDAD</td>
        <td>DESCRIPCIÓN<br>(COLOR, TALLA, MATERIAL, ETC.)</td>
    </tr>

    @foreach ($requisicion->detalles as $detalle)
        <tr>
            <td>{{ $detalle->item->codigo_insumo ?? '' }}</td>
            <td>{{ $detalle->item->presentacion->nombre ?? '' }}</td>
            <td>{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td>{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td class="left">{{ $detalle->item->descripcion === '<p>&nbsp;</p>' || !$detalle->item->descripcion ? 'Sin Descripción' : $detalle->item->descripcion }}</td>
        </tr>
    @endforeach

    @for ($i = count($requisicion->detalles); $i < 15; $i++)
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @endfor

    <tr>
        <td colspan="8" class="center">. . . . . . . . . Última Línea . . . . . . . . . </td>
    </tr>
</table>

<!-- Justificación -->
<table style="margin-top: 15px; width: 100%">
    <tr>
        <td class="left" colspan="4" style="border: none">JUSTIFICACIÓN DE LA COMPRA:</td>
    </tr>
    <tr>
        <td class="left" colspan="4" style="height: 50px; width: 100%">
            {{$requisicion->justificacion ?? ''}}
        </td>
    </tr>
</table>

<table style="margin-top: 15px; width: 100%; border: 1px solid black; border-collapse: collapse;">
    <tr>
        <td style="width: 50%; border: none; text-align: center; padding: 50px;">

        </td>
        <td style="width: 50%; border: none; text-align: center; padding: 50px;">

        </td>
    </tr>
</table>

<!-- Subproducto y partidas -->
<table style="margin-top: 15px; width: 100%; border: 1px solid black; border-collapse: collapse; ">
    <tr class="section-title">
        <td style="width: 50%; border: none; text-align: center;" colspan="2">
            EXCLUSIVO DEPARTAMENTO DE PRESUPUESTOS
        </td>
    </tr>
    <tr>
        <!-- Sub Productos -->
        <td style="width: 35%; vertical-align: top; border: none; text-align: center;">
            <table style="width: 75%; border-collapse: collapse; margin: 15px auto;">
                <tr>
                    <td style="border: none; font-weight: bold; text-align: start;">
                        SUB PRODUCTOS:
                    </td>
                </tr>
                @foreach(explode('|', $requisicion->subproductos) as $producto)
                    <tr>
                        <td style="height: 20px; text-align: start;">{{ $producto }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
        <!-- Partidas Presupuestarias -->
        <td style="width: 35%; vertical-align: top; border: none;">
            <table style="width: 75%; border-collapse: collapse; margin: 15px auto;">
                <tr>
                    <td style="border: none; font-weight: bold; text-align: start">
                        PARTIDAS PRESUPUESTARIAS:
                    </td>
                </tr>
                @foreach(explode('|', $requisicion->partidas) as $partida)
                    <tr>
                        <td style="height: 20px; text-align: start;">{{ $partida }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
    <tr style="border: none;">
        <td style="border: none;"></td>
        <td style="border: none; text-align: center;">
            <div style="border: 1px solid black; width: 350px; height: 70px; margin: auto;"></div>
            <div style="margin-top: 5px">FIRMA RESPONSABLE DE CODIFICACIÓN</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border: none; height: 10px;"></td>
    </tr>
</table>

</body>
</html>
