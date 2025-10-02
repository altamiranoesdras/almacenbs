
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
<table style="margin-top: 18px; width: 100%; border-collapse: collapse; border: 1px solid rgba(2,24,98,0.86);" id="tablaDetalles">
    <tr class="section-title" style="border-bottom: 1px solid black; background: #1B244B; color: white">
        <td style="border: none; padding: 7px;">RENGLÓN</td>
        <td style="border: none; padding: 7px;">DESCRIPCION</td>
        <td style="border: none; padding: 7px;">UNIDAD DE MEDIDA</td>
        <td style="border: none; padding: 7px;">VALOR UNITARIO</td>
        <td style="border: none; padding: 7px;">VALOR TOTAL</td>
    </tr>
    @foreach ($solicitud->detalles as $detalle)
        <tr>
            <td >{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="left" >
                {{ $detalle->item->descripcion === '<p>&nbsp;</p>' || !$detalle->item->descripcion ? 'Sin Descripción' : $detalle->item->descripcion }}
            </td>
            <td >{{ $detalle->item->unimed->nombre ?? 'Sin Unidad de medida' }}</td>
            <td >{{ dvs() .nf($detalle->precio) ?? '' }}</td>
            <td >{{ dvs(). nf($detalle->precio * $detalle->cantidad_despachada) }}</td>
        </tr>
    @endforeach

    @for ($i = count($solicitud->detalles); $i < 22; $i++)
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @endfor
</table>

<table style="margin-top: 5px; width: 100%; border-collapse: collapse;">
    <tr>
        <td class="left" style="height: 5px; width: 75%; border: none; vertical-align: top;">
            <strong>TOTAL EN LETRAS: </strong>{{$solicitud->total_letras}}<br>
        </td>
        <td style="height: 5px; width: 25%; border: none; vertical-align: top; text-align: right">
            <strong>TOTAL: </strong> {{ dvs(). nfp($solicitud->total_detalles) }}<br><br>
        </td>
    </tr>
</table>

<footer>
    <table style="width: 100%">
        <tr>
            <td class="left" colspan="4" style="border: none">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td class="left" colspan="4" style="height: 55px; width: 100%">
                {{$solicitud->observaciones ?? ''}}
            </td>
        </tr>
    </table>

    <table style="margin-top: 80px; width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                SOLICITADO POR
            </td>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                APROBADO POR
            </td>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                DESPACHADO POR
            </td>
        </tr>
    </table>

    <table style="margin-top: 30px; width: 100%; border-collapse: collapse;">
        <tr style="height: 25px;">
            <td style="border: none; width: 100%; text-align: left;">
                RECIBIDO POR: _____________________________________________________________________________________________________________________________
            </td>
        </tr>
        <tr style="height: 15px;">
            <td style="border: none; width: 100%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="padding: 5px">
                        <td style="border: none; text-align: left; width: 50%; padding: 15px 0; font-size: 11px">
                            FECHA RECIBIDO: ___________________________________________
                        </td>
                        <td style="border: none; text-align: right; width: 50%; font-size: 11px">
                            FIRMA: ___________________________________________
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 5px; width: 100%;border-collapse: collapse; font-size: 11px">
        <tr>
            <td style="width: 15%; border: none; text-align: center;"></td>
            <td style="width: 70%; border: none; text-align: center;">
                Autorizado según Resolución de la Contraloría General de Cuentas No. F.O. {{ $envioFiscal->numero_cuenta }}  Gestión: {{ $envioFiscal->numero_gestion }} de
                fecha {{ fechaLtn($envioFiscal->fecha_gestion) }}, correlativo {{ $envioFiscal->correlativo }} de
                fecha {{ fechaLtn($envioFiscal->fecha)  }}, Envío fiscal {{ $envioFiscal->folio }} de fecha {{fechaLtn($envioFiscal->fecha)}},
                Autorizado del {{ nfp($envioFiscal->correlativo_del, 0) }} al {{ nfp($envioFiscal->correlativo_al, 0) }} Serie {{ $envioFiscal->serie }}, Libro
                {{ $envioFiscal->libro }} Folio {{ $envioFiscal->folio }} SECRETARÍA DE
                BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA NIT 3377881
            </td>
            <td style="width: 15%; border: none; text-align: center;"></td>
        </tr>
        <tr style="height: 40px">
            <td  colspan="3" style="width: 100%; border: none; text-align: center; color: #cd0303; font-weight: bold; vertical-align: middle;">
                <h3>{{ $textoFooter }}</h3></td>
        </tr>
    </table>
</footer>

</body>
</html>
