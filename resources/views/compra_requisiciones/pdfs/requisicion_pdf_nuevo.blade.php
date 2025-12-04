<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>REQUISICIÓN DE COMPRA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap');


        body {
            font-family: "Roboto Condensed", "Bahnschrift", sans-serif;
            /*font-family: DejaVu Sans, sans-serif;*/
            font-size: 11px;
        }

        /* COLOR DE FUENTE GLOBAL */
        body, table, td, th, span, label, h1, h3, h5, div {
            color: #24325d !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #24325d;
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
            border-left: 1px solid #24325d;
            border-right: 1px solid #24325d;
            border-bottom: none;
            border-top: none;
        }
        #tablaDetalles thead tr th {
            font-weight: bold;
            background: #1B244B;
            color: white !important;
            padding: 10px 2px;
        }
        #tablaDetalles tfoot tr th {
            border-bottom: none;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .celda-codigo {
            width: 8%;
        }
        .celda-presentacion {
            width: 8%;
        }
        .celda-renglon {
            width: 8%;
        }
        .celda-unidad-medida {
            width: 8%;
        }
        .celda-cantidad {
            width: 8%;
        }
        .celda-descripcion {
            width: 60%;
            text-align: left;
        }
        .texto-negrita {
            font-weight: bold;
        }
        .tamanio-texto-general {
            font-size: 11px;
        }

        .titulo-afectacion {
            margin-top: 15px;
            margin-bottom: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #24325d;
        }

        /* Contenedor con borde y esquinas redondeadas */
        .tabla-afectacion {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #24325d;
            border-radius: 4px;
            font-size: 10px;
        }

        .tabla-afectacion td {
            border: none;
            padding: 6px 10px;
            vertical-align: top;
        }

        /* Alineaciones */
        .afectacion-izquierda {
            text-align: left;
        }

        .afectacion-derecha {
            text-align: right;
        }

        /* Texto de PR SP PY… y SUBPRODUCTO con línea inferior */
        .afectacion-encabezado {
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 1px solid #24325d;
            padding-bottom: 2px;
            display: inline-block;
        }

        /* Texto de partidas / subproductos */
        .afectacion-texto {
            font-weight: bold;
            font-size: 11px;
        }

        /* ===== Encabezado institucional ===== */
        .encabezado-tabla {
            width: 100%;
            border: 1px solid #24325d;
        }

        .encabezado-tabla .celda-logo {
            width: 20%;
            text-align: center;
            vertical-align: top;
            padding: 0px;
            font-size: 9px;
            font-weight: bold;
        }

        .encabezado-tabla .celda-titulo {
            width: 55%;
            text-align: center;
            vertical-align: middle;
            font-size: 18px !important;
            font-weight: bold;
        }

        .encabezado-tabla .celda-numero-fecha {
            width: 25%;
            text-align: left;
            vertical-align: middle;
            font-size: 12px;
            font-weight: bold;
        }

        .encabezado-numero {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .encabezado-fecha {
            font-weight: bold;
            font-size: 12px;
        }


        /* Quita bordes a la tabla del encabezado */
        .no-border {
            border: none !important;
        }
        .no-border td,
        .no-border th {
            border: none !important;
            padding: 0;
        }

        /* ===== UNIDAD REQUERIENTE ===== */
        .tabla-unidad {
            width: 100%;
            border: none !important;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .tabla-unidad  td {
            padding-top: 15px;
            padding-bottom: 15px;
            font-size: 14px;
        }

        .celda-label-unidad {
            width: 22%;
            font-weight: bold;
            text-align: left;
            padding-left: 10px;
            border: none !important;
        }

        .celda-nombre-unidad {
            width: 78%;
            text-align: left;
            font-weight: bold;
            padding-left: 10px;
            border-radius: 5px;
            border: 1px solid #24325d;
        }





    </style>
</head>
<body>

<!-- Encabezado institucional -->
<table class="encabezado-tabla no-border">
    <tr>
        <td class="celda-logo">
            <img src="{{ asset('img/logos/Logo_Secretaria_BS.png') }}" style="width: 200px" alt="Logo" class="logo-secretaria">
            <br>
            <span class="direccion-secretaria">32 Calle 9-34 Zona 11, Las Charcas</span><br>
            <span class="nit-secretaria">NIT: 3377881</span>
        </td>
        <td class="celda-titulo">
            REQUISICIÓN DE COMPRA
        </td>
        <td class="celda-numero-fecha">
            <div class="encabezado-numero">Número: {{ $requisicion->codigo }}</div>
            <div class="encabezado-fecha">Fecha: {{ fechaLtn($requisicion->created_at) }}</div>
        </td>
    </tr>
</table>

<!-- Unidad requirente -->
<table class="tabla-unidad">
    <tr>
        <td class="celda-label-unidad">
            UNIDAD REQUERIENTE
        </td>

        <td class="celda-nombre-unidad">
            {{ $requisicion->unidad->nombre ?? '' }}
        </td>
    </tr>

</table>


<table class="table table-sm" id="tablaDetalles">
    <thead>
    <tr style="border-right: 1px black solid ">
        <th class="encabezado-codigo">CÓDIGO DE INSUMO</th>
        <th class="encabezado-presentacion">CODIGO DE PRESENTACION</th>
        <th class="encabezado-renglon">RENGLÓN</th>
        <th class="encabezado-unidad-medida">UNIDAD DE MEDIDA</th>
        <th class="encabezado-cantidad">CANTIDAD</th>
        <th class="encabezado-descripcion">DESCRIPCION DEL PRODUCTO (Espesificar color, tamaño, talla, grosor, material, entre otros)</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($requisicion->detalles as $detalle)
        <tr class="p-0 border-0 " style="font-size: 10px">
            <td class="celda-codigo">{{ $detalle->item->codigo_insumo ?? '' }}</td>
            <td class="celda-presentacion">{{ $detalle->item->codigo_presentacion ?? '' }}</td>
            <td class="celda-renglon">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="celda-unidad-medida">{{ $detalle->item->unimed->nombre ?? '' }}</td>
            <td class="celda-cantidad">{{ $detalle->cantidad ?? '' }}</td>
            <td class="celda-descripcion">{!! limpiarHtml($detalle->item->texto_requisicion_compra ?? '') !!} </td>
        </tr>
    @endforeach

    @for ($i = count($requisicion->detalles); $i < 18; $i++)
        <tr class="border-0 p-0">
            <td class="text-center">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
        <td class="left" style="border: none">JUSTIFICACIÓN:</td>
    </tr>
    <tr>
        <td style="height: 50px; width: 100%; vertical-align: top;" class="texto-negrita tamanio-texto-general left">
            {{$requisicion->justificacion ?? ''}}
        </td>
    </tr>
</table>


<h5 class="titulo-afectacion">
    AFECTACIÓN PRESUPUESTARIA
</h5>

<table class="tabla-afectacion">
    <tr>
        <td class="afectacion-izquierda">
            <span class="afectacion-encabezado">
                PR&nbsp;&nbsp;SP&nbsp;&nbsp;PY&nbsp;&nbsp;AC&nbsp;&nbsp;OB&nbsp;&nbsp;REN&nbsp;&nbsp;UBG&nbsp;&nbsp;FTE
            </span>
        </td>
        <td class="afectacion-derecha">
            <span class="afectacion-encabezado">
                SUBPRODUCTO
            </span>
        </td>
    </tr>

    <tr>
        <td class="afectacion-izquierda">
            @foreach($requisicion->obtenerPartidas() as $partida)
                <div class="afectacion-texto">{{ $partida }}</div>
            @endforeach
        </td>
        <td class="afectacion-derecha">
            @foreach($requisicion->obtenerSubProductos() as $subProducto)
                <div class="afectacion-texto">{{ $subProducto }}</div>
            @endforeach
        </td>
    </tr>
</table>


</body>
</html>
