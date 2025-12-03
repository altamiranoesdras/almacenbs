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
        .left {
            text-align: left;
        }
        #tablaDetalles tr td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: none;
            border-top: none;
        }
        #tablaDetalles thead tr th {
            font-weight: bold;
            background: #1B244B;
            color: white;
            padding: 10px 2px;
        }
        #tablaDetalles tfoot tr th {
            border-bottom: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }
        .sin-border {
            border: 1px white solid !important;
        }
        .texto-negrita {
            font-weight: bold;
        }
        .tamanio-texto-general {
            font-size: 11px;
        }

    </style>
</head>
<body>

<!-- Encabezado institucional -->
<table class="no-border">
    <tr>
        <td style="width: 100%; padding: 0;">
            <div style="display: table; width: 100%; border-collapse: collapse;">
                <div style="display: table-cell; width: 25%; vertical-align: middle;">
                    <img src="{{ asset('img/logos/Logo_Secretaria_BS.png') }}" alt="Logo" style="width: 100%;">
                    <span style="font-weight: bold; margin-top: 10px">32 Calle 9-34 Zona 11, Las Charcas</span><br>
                    <span style="font-weight: bold"><strong>NIT:</strong> 3377881</span>
                </div>
                <div style="display: table-cell; width: 60%; text-align: center; vertical-align: middle;">
                    <h2 style="font-weight: bold;">REQUISICIÓN DE COMPRA</h2>
                </div>
                <div style="display: table-cell; width: 20%; text-align: start; vertical-align: middle;">
                    <label style="font-weight: bold; font-size: 15px">Numero: </label><span>{{$requisicion->codigo}}</span><br><br>
                    <label style="font-weight: bold; font-size: 15px">Fecha: </label><span>{{fechaLtn($requisicion->created_at)}}</span>
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- Unidad solicitante -->
<table style="margin-top: 15px; margin-bottom: 20px; width: 100%">
    <tr>
        <td style="border: none; width: 20%">
            <h3>UNIDAD REQUIRENTE:</h3>
        </td>

        <td class="left" style="text-align: center; width: 80%">
            <h3 class="texto-negrita">{{ $requisicion->unidad->nombre ?? '' }}</h3>
        </td>
    </tr>
</table>

<table class="table table-sm" id="tablaDetalles">
    <thead>
    <tr style="border-right: 1px black solid ">
        <th width="5%">CODIGO INSUMO</th>
        <th width="5%">CODIGO DE PRESENTACION</th>
        <th width="5%">RENGLÓN</th>
        <th width="5%">UNIDAD DE MEDIDA</th>
        <th width="10%">CANTIDAD</th>
        <th width="65%">DESCRIPCION DEL PRODUCTO (Espesificar color, tamaño, talla, grosor, material, entre otros)</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($requisicion->detalles as $detalle)
        <tr class="p-0 border-0 " style="font-size: 8px">
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->item->codigo ?? '' }}</td>
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->item->codigo_presentacion ?? '' }}</td>
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->cantidad ?? '' }}</td>
            <td class="text-center texto-negrita tamanio-texto-general">{{ $detalle->item->descripcion ?? '' }}</td>
        </tr>
    @endforeach

    @for ($i = count($requisicion->detalles); $i < 18; $i++)
        <tr class="border-0 p-0">
            <td class="text-center" >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
    @endfor
    <tr style="border: 1px black solid">
        <td class="text-center" colspan="6">. . . . . . . . . Última Línea . . . . . . . . . </td>
    </tr>
    </tbody>
</table>

<!-- Justificación -->
<table style="margin-top: 15px; width: 100%">
    <tr>
        <td class="left" colspan="4" style="border: none">JUSTIFICACIÓN:</td>
    </tr>
    <tr>
        <td class="left" colspan="4" style="height: 50px; width: 100%" class="texto-negrita tamanio-texto-general">
            {{$requisicion->justificacion ?? ''}}
        </td>
    </tr>
</table>

<table style="margin-top: 15px; width: 100%">
    <tr>
        <td class="left" colspan="4" style="border: none">AFECTACIÓN PRESUPUESTARIA:</td>
    </tr>
    <tr>
        <td class="left" colspan="4" style="height: 50px; width: 100%">
            <table style="width: 100%">
                <tr>
                    <td class="left" style="border: none;">
                        <span style="border-bottom: 1px solid black" class="texto-negrita">
                            PR  SP  PY  AC  OB  REN  UBG  FTE
                        </span>
                    </td>
                    <td class="right" style="border: none;">
                        <span style="border-bottom: 1px solid black" class="texto-negrita">SUB PRODUCTO</span>
                    </td>
                </tr>
                <tr>
                    <td class="left" style="border: none;">
                        <span>PARTIDAS PRESUPUESTARIAS ASIGNADAS AL GASTO</span>
                    </td>
                    <td class="right" style="border: none;">
                        <span>FIRMA Y SELLO JEFE DE PRESUPUESTO</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table class="no-border" style="margin-top: 40px">
    <tr style="border: none;" class="sin-border">
        <td class="left" colspan="4" style="height: 50px; width: 100%">
            <table style="width: 100%">
                <tr>
                    <td class="left" style="border: none; text-align: center; padding: 65px;">
                        _________________________________<br><br>
                        <span class="texto-negrita tamanio-texto-general">REQUIRENTE</span>
                    </td>
                    <td class="right" style="border: none; text-align: center; padding: 50px;">
                        _________________________________<br><br>
                        <span class="texto-negrita tamanio-texto-general">AUTORIZADOR</span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="right" style="border: none; text-align: center; padding: 50px;">
                        _________________________________<br><BR>
                        <span class="texto-negrita tamanio-texto-general">VERIFICACION PRESUPUESTARIA</span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
