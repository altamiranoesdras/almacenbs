
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
        #datosGenerales tr td {
            height: 5px;
            width: 75%;
            border: none;
            padding: 8px 15px;
        }
        #datosGenerales {
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #00008f;
            padding: 10px;
        }
        #datosGenerales tr {
            padding: 10px;
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
                </div>
            </div>
            <div style="width: 100%">
                <h2 style="color: #1B244B">FORMA 1-H CONSTANCIA DE INGRESO A ALMACÉN Y A INVENTARIOS</h2>
            </div>
        </td>
    </tr>
</table>

<!-- Datos generales -->
<table id="datosGenerales">
    <tr>
        <td class="left" >
            <strong>NOMBRE DEL PROVEEDOR: </strong>{{$compra->proveedor->nombre ?? ''}}<br>
        </td>
        <td class="left" >

        </td>
    </tr>
    <tr>
        <td class="left" >
            <strong>NIT: </strong> {{$compra->proveedor->nit ?? ''}}
        </td>
        <td class="left" >
            <strong>FECHA: </strong>{{fechaLtn($compra->fecha_ingreso) ?? ''}}<br>

        </td>
    </tr>
    <tr>
        <td class="left" >
            <strong>NO. DOCUMENTO: </strong> {{$compra->compra1h->folio ?? ''}}
        </td>
        <td class="left" >
            <strong>ORDEN DE COMPRA: </strong> {{$compra->orden_compra ?? ''}}
        </td>
    </tr>
</table>

<!-- Detalle de insumos -->
<table style="margin-top: 25px; width: 100%; border-collapse: collapse; border: 1px solid rgba(2,24,98,0.86);">
    <tr class="section-title" style="border-bottom: 1px solid black; background: #1B244B; color: white">
{{--        <td style="border: none; padding: 7px;">Numero</td>--}}
        <td style="border: none; padding: 7px;">RENGLÓN</td>
        <td style="border: none; padding: 7px;">DESCRIPCION DEL PRODUCTO</td>
        <td style="border: none; padding: 7px;">CANTIDAD</td>
        <td style="border: none; padding: 7px;">VALOR UNITARIO</td>
        <td style="border: none; padding: 7px;">VALOR TOTAL</td>
    </tr>
    @foreach ($compra->compra1h->detalles as $index => $detalle)
        <tr>
{{--            <td style="border: none;">{{ $index ?? '' }}</td>--}}
            <td style="border: none;">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="left" style="border: none;">
                {{ $detalle->item->descripcion === '<p>&nbsp;</p>' || !$detalle->item->descripcion ? 'Sin Descripción' : $detalle->item->descripcion }}
            </td>
            <td style="border: none;">{{ (int)$detalle->cantidad }}</td>
            <td style="border: none;">{{ dvs() .nfp($detalle->precio) ?? '' }}</td>
            <td style="border: none;">{{ dvs(). nfp($detalle->precio * $detalle->cantidad) }}</td>
        </tr>
    @endforeach

    @for ($i = count($compra->compra1h->detalles); $i < 23; $i++)
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
            <strong>TOTAL EN LETRAS: </strong>{{$compra->compra1h->total_letras ?? ''}}<br>
        </td>
        <td class="left" style="height: 5px; width: 25%; border: none; vertical-align: top;">
            <strong>SUBTOTAL: </strong>{{dvs() .nfp($compra->compra1h->sub_total) ?? ''}}<br><br>
            <strong>DESCUENTO: </strong>{{dvs() .nfp($compra->compra1h->descuento ?? $compra->descuento) ?? ''}}<br><br>
            <strong>TOTAL: </strong>{{dvs() .nfp($compra->compra1h->total) ?? ''}}<br><br>
        </td>
    </tr>
</table>


</body>
</html>
