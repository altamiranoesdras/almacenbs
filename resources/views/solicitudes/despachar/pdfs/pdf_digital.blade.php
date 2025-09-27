
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>REQUISICIÓN DE ALMACEN</title>
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
                <div style="display: table-cell; width: 10%; vertical-align: middle;">
                    <img src="{{ asset('img/logos/Logo_Gobierno_Republica.png') }}" alt="Logo" style="width: 100px;">
                </div>
                <div style="display: table-cell; width: 80%; vertical-align: middle;">
                    <h2 style="color: #1B244B">SECRETARÍA DE BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA</h2>
                    <h3 style="color: #1B244B">DEPARTAMENTO DE ALMACEN</h3>
                    <h3 style="color: #1B244B">32 Calle 9-34 Zona 11, Las Charcas</h3>
                    <h3 style="color: #1B244B">NIT: 3377881</h3>
                </div>
                <div style="display: table-cell; width: 10%; vertical-align: middle;">
                    <img src="{{ asset('img/logos/Logo_CGC_FT.png') }}" alt="Logo" style="width: 100px;">
                    <h4>{{ $solicitud->correlativo }}</h4>
                </div>
            </div>
            <div style="width: 100%">
                <h2 style="color: #1B244B">REQUISICION DE ALMACEN</h2>
            </div>
        </td>
    </tr>
</table>

<!-- Datos generales -->
<table style="margin-top: 15px; width: 100%; border-collapse: collapse; border: 1px solid #00008f; padding: 10px;">
    <tr>
        <td class="left" style="height: 5px; width: 100%; border: none; padding: 10px">
            <strong>SIRVASE ENTREGAR A: </strong>{{$solicitud->usuarioSolicita->name ?? ''}}<br>
        </td>
    </tr>
    <tr>
        <td class="left" style="height: 5px; width: 100%; border: none; padding: 10px">
            <strong>FECHA: </strong>{{fechaLtn($solicitud->fecha_solicita) ?? ''}}<br>
        </td>
    </tr>
</table>

<!-- Detalle de insumos -->
<table style="margin-top: 25px; width: 100%; border-collapse: collapse; border: 1px solid rgba(2,24,98,0.86);">
    <tr class="section-title" style="border-bottom: 1px solid black; background: #1B244B; color: white">
        <td style="border: none; padding: 7px;">RENGLÓN</td>
        <td style="border: none; padding: 7px;">DESCRIPCION</td>
        <td style="border: none; padding: 7px;">UNIDAD DE MEDIDA</td>
        <td style="border: none; padding: 7px;">VALOR UNITARIO</td>
        <td style="border: none; padding: 7px;">VALOR TOTAL</td>
    </tr>
    @foreach ($solicitud->detalles as $detalle)
        <tr>
            <td style="border: none;">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="left" style="border: none;">
                {{ $detalle->item->descripcion === '<p>&nbsp;</p>' || !$detalle->item->descripcion ? 'Sin Descripción' : $detalle->item->descripcion }}
            </td>
            <td style="border: none;">{{ $detalle->item->unimed->nombre ?? 'Sin Unidad de medida' }}</td>
            <td style="border: none;">{{ dvs() .nf($detalle->precio) ?? '' }}</td>
            <td style="border: none;">{{ dvs(). nf($detalle->precio * $detalle->cantidad_despachada) }}</td>
        </tr>
    @endforeach

    @for ($i = count($solicitud->detalles); $i < 23; $i++)
        <tr>
            <td style="border: none;">&nbsp;</td>
            <td style="border: none;">&nbsp;</td>
            <td style="border: none;">&nbsp;</td>
            <td style="border: none;">&nbsp;</td>
            <td style="border: none;">&nbsp;</td>
        </tr>
    @endfor
</table>

<table style="margin-top: 5px; width: 100%; border-collapse: collapse;">
    <tr>
        <td class="left" style="height: 5px; width: 75%; border: none; vertical-align: top;">
            <strong>TOTAL EN LETRAS: </strong>Pendiente<br>
        </td>
        <td class="left" style="height: 5px; width: 25%; border: none; vertical-align: top;">
            <strong>TOTAL: </strong> {{ dvs(). nfp($solicitud->total_detalles) }}<br><br>
        </td>
    </tr>
</table>

</body>
</html>
