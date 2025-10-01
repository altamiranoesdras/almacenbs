
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>REQUISICIÓN DE COMPRA</title>
    {{--libreria bootstrap--}}
    <link href="{{asset('css/bootstrap5.min.css')}}" rel="stylesheet" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        #datosGenerales tr td {

            height: 5px;
            width: 75%;
            padding: 8px 15px;
        }
        #datosGenerales {
            border: 1px solid #1B244B;
            border-radius: 15px !important;
            margin-top: 15px;
            width: 100%;
            padding: 10px;
        }
        #datosGenerales tr {
            padding: 10px;
        }
        #encabezado tr td {
            vertical-align: top;
            text-align: center;
        }
        #encabezado div {
            color: #1B244B;
            font-weight: bolder;
            font-size: 15px;
            margin: 0;
            padding: 0;
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
    </style>
</head>
<body>

<!-- Encabezado institucional -->
<table class="table" id="encabezado" style="border: 1px white solid">
    <tr class="border-0">
        <td class="border-0">
            <img src="{{ asset('img/logos/Logo_Gobierno_Republica.png') }}" alt="Logo" style="width: 100px;">
        </td>
        <td class="border-0">
            <div>SECRETARÍA DE BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA</div>
            <div>DEPARTAMENTO DE ALMACEN</div>
            <div>32 Calle 9-34 Zona 11, Las Charcas</div>
            <div>NIT: 3377881</div>
        </td>
        <td class="border-0">
            <img src="{{ asset('img/logos/Logo_CGC_FT.png') }}" alt="Logo" style="width: 100px;">
        </td>
    </tr>
    <tr class="border-0">
        <td colspan="3" class="pt-4 pb-3 border-0">
            <div>FORMA 1-H CONSTANCIA DE INGRESO A ALMACÉN Y A INVENTARIOS</div>
        </td>
    </tr>
</table>


<!-- Datos generales -->
<table class="table border-" id="datosGenerales">
    <tr class="border-0">
        <td class="text-start border-0" >
            <strong>NOMBRE DEL PROVEEDOR: </strong>{{$compra->proveedor->nombre ?? ''}}<br>
        </td>
        <td class="text-start border-0" >

        </td>
    </tr>
    <tr class="border-0">
        <td class="text-start border-0" >
            <strong>NIT: </strong> {{$compra->proveedor->nit ?? ''}}
        </td>
        <td class="text-start border-0" >
            <strong>FECHA: </strong>{{fechaLtn($compra->fecha_ingreso) ?? ''}}<br>

        </td>
    </tr>
    <tr class="border-0">
        <td class="text-start border-0" >
            <strong>NO. DOCUMENTO: </strong> {{$compra->compra1h->folio ?? ''}}
        </td>
        <td class="text-start border-0" >
            <strong>ORDEN DE COMPRA: </strong> {{$compra->orden_compra ?? ''}}
        </td>
    </tr>
</table>


<!-- Detalle de insumos -->
<table class="table table-sm" id="tablaDetalles">
    <thead>
        <tr>
            {{--        <td style="border: none; padding: 7px;">Numero</td>--}}
            <th width="5%">RENGLÓN</th>
            <th width="65%">DESCRIPCION DEL PRODUCTO</th>
            <th width="10%">CANTIDAD</th>
            <th width="10%">VALOR UNITARIO</th>
            <th width="10%">VALOR TOTAL</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($compra->compra1h->detalles as $index => $detalle)
        <tr class="border-0">
            {{--            <td style="border: none;">{{ $index ?? '' }}</td>--}}
            <td class="text-center">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="text-start" >
                {{ $detalle->item->descripcion === '<p>&nbsp;</p>' || !$detalle->item->descripcion ? 'Sin Descripción' : $detalle->item->descripcion }}
            </td>
            <td class="text-center">{{ (int)$detalle->cantidad }}</td>
            <td class="text-end">{{ dvs() .nfp($detalle->precio) ?? '' }}</td>
            <td class="text-end">{{ dvs(). nfp($detalle->precio * $detalle->cantidad) }}</td>
        </tr>
    @endforeach

    @for ($i = count($compra->compra1h->detalles); $i < 23; $i++)
        <tr class="border-0">
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
    @endfor

    </tbody>

    <tfoot style="border: 1px white solid; border-top: 1px black solid">
    <tr>
        <th class="text-start" colspan="3" >
            TOTAL EN LETRAS: {{$compra->compra1h->total_letras ?? ''}}
        </th>
        <th class="text-start" >
            SUBTOTAL
        </th>
        <th class="text-end" >
            {{dvs() .nfp($compra->compra1h->sub_total) ?? ''}}
        </th>

    </tr>
    <tr >
        <th colspan="3">
        </th>
        <th class="text-start" >
            DESCUENTO:
        </th>
        <th class="text-end" >
            {{dvs() .nfp($compra->compra1h->descuento ?? $compra->descuento) ?? ''}}
        </th>
    </tr>
    <tr>
        <th colspan="3">
        </th>
        <th class="text-start"  >
            TOTAL:
        </th>
        <th class="text-end" >
            {{dvs() .nfp($compra->compra1h->total) ?? ''}}
        </th>
    </tr>
    </tfoot>

</table>
<footer>

    <!-- Justificación -->
    <table style="margin-top: 15px; width: 100%">
        <tr>
            <td class="left" colspan="4" style="border-top: 1px white solid; border-left: 1px white solid; border-right: 1px white solid;">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td class="left" colspan="4" style="height: 6rem; width: 100%">
                {{$compra->compra1h->observaciones ?? ''}}
            </td>
        </tr>
    </table>

    <table style="margin-top: 80px; width: 100%;border-collapse: collapse;" class="sin-border">
        <tr>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                OPERADO POR
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                JEFE DE ALMACEN
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                DIRECTOR ADMINISTRATIVO
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                JEFE DE INVENTARIOS
            </td>
        </tr>
    </table>

    <table style="margin-top: 40px; width: 100%;border-collapse: collapse;" class="sin-border">
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
        <tr>
            <td colspan="3" style="width: 100%; border: none; text-align: center; color: #cd0303; font-weight: bold">
                <h3>{{ $textoFooter }}</h3></td>
        </tr>
    </table>
</footer>
</body>
</html>
