
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario 1H</title>
    {{--libreria bootstrap--}}
    <link href="{{asset('css/bootstrap5.min.css')}}" rel="stylesheet" />
    <style>
        /* Imagen centrada en toda la página, sin afectar márgenes */
        .marca-anulado {
            position: fixed;
            top: 20rem;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 70%;             /* ajusta el tamaño */
            opacity: 0.5;          /* ajusta transparencia (usa 1 si la quieres opaca) */
            pointer-events: none;
        }
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

@if($compra->estaAnulada())
    <!-- Imagen centrada (no afecta estructura ni medidas del contenido) -->
    <img src="{{ public_path('img/anulado.png') }}" alt="ANULADO" class="marca-anulado">
@endif

<!-- Encabezado institucional -->
<table class="table" id="encabezado" style="border: 1px white solid">
    <tr class="">
        <td class="border-0">
            <img src="{{ asset('img/logos/Logo_Gobierno_Republica.png') }}" alt="Logo" style="width: 100px;">
        </td>
        <td class="border-0">
            <div>SECRETARÍA DE BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA</div>
            <div>DEPARTAMENTO DE ALMACEN</div>
            <div>32 Calle 9-34 Zona 11, Las Charcas</div>
            <div>NIT: 3377881</div>
        </td>
        <td class="border-0 p-0">
            <img src="{{ asset('img/logos/Logo_CGC_FT.png') }}" alt="Logo" style="width: 95px;">
            <div style="font-size: 10px;" class="p-0">
                <b>

                    Correlativo CGC No {{ $compra->compra1h->folio }}
                    <br>
                    Electrónico
                </b>
            </div>
        </td>
    </tr>
    <tr class="border-0 p-o">
        <td colspan="3" class="pt-4 pb-3 border-0 p-0">
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
            <strong>NO. DOCUMENTO: </strong> {{$compra->serie ?? ''}} - {{$compra->numero ?? ''}}
        </td>
        <td class="text-start border-0" >
            <strong>ORDEN DE COMPRA: </strong> {{$compra->orden_compra ?? ''}}
        </td>
    </tr>
</table>


<!-- Detalle de insumos -->
<table class="table table-sm" id="tablaDetalles">
    <thead>
        <tr style="border-right: 1px black solid ">
            <th width="5%">RENGLÓN</th>
            <th width="65%">DESCRIPCION DEL PRODUCTO</th>
            <th width="10%">CANTIDAD</th>
            <th width="10%">VALOR UNITARIO</th>
            <th width="10%">VALOR TOTAL</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($compra->compra1h->detalles as $index => $detalle)
        <tr class="p-0 border-0 " style="font-size: 8px">
            <td class="text-center">{{ $detalle->item->renglon->numero ?? '' }}</td>
            <td class="text-start" >
                {{mb_strtoupper($detalle->text)}}
            </td>
            <td class="text-center">{{ (int)$detalle->cantidad }}</td>
            <td class="text-end">{{ dvs() .nfp($detalle->precio) ?? '' }}</td>
            <td class="text-end">{{ dvs(). nfp($detalle->precio * $detalle->cantidad) }}</td>
        </tr>
    @endforeach

    @for ($i = count($compra->compra1h->detalles); $i < 20; $i++)
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
    <tr style="font-size: 10px; padding: 0">
        <th class="pb-0 text-start" colspan="3" >
            TOTAL EN LETRAS: {{$compra->compra1h->total_letras ?? ''}}
        </th>
        <th class="pb-0 text-start" >
            SUBTOTAL
        </th>
        <th class="pb-0 text-end" >
            {{dvs() .nfp($compra->compra1h->sub_total) ?? ''}}
        </th>
    </tr>
    <tr style="font-size: 10px; padding: 0">
        <th colspan="3"></th>
        <th class="pb-0 text-start" >
            DESCUENTO:
        </th>
        <th class="pb-0 text-end" >
            {{dvs() .nfp($compra->descuento) ?? ''}}
        </th>
    </tr>
    <tr style="font-size: 10px; padding: 0">
        <th colspan="3">
        </th>
        <th class="pb-0 text-start"  >
            TOTAL:
        </th>
        <th class="pb-0 text-end" >
            {{dvs() .nfp($compra->compra1h->total) ?? ''}}
        </th>
    </tr>
    </tfoot>

</table>
<footer>

    <!-- observaciones -->
    <table style="margin-top: 10px; width: 100%" id="observaciones">
        <tr>
            <td class="left" colspan="4" style="border-top: 1px white solid; border-left: 1px white solid; border-right: 1px white solid;">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td class="left" colspan="4" style="height: 3rem; width: 100%; font-size: 10px; vertical-align: top; border: solid 1px;">
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

    <table style="margin-top: 35px; width: 100%;border-collapse: collapse; font-size: 10px; border-color: white" >
        <tr>
            <td style="width: 15%; border: none; text-align: center;"></td>
            <td style="width: 70%; border: none; text-align: center;">
                Autorizado según Resolución de la Contraloría General de Cuentas No. F.O. {{ $envioFiscal->numero_resolucion }}  Gestión: {{ $envioFiscal->numero_gestion }} de
                fecha {{ fechaLtnGn($envioFiscal->fecha_gestion) }}, correlativo {{ $envioFiscal->correlativo_resolucion }} de
                fecha {{ fechaLtnGn($envioFiscal->fecha_correlativo_resolucion)  }}, Envío fiscal {{ $envioFiscal->serie_envio }} de fecha {{fechaLtnGn($envioFiscal->fecha_envio)}},
                Autorizado del {{ nfp($envioFiscal->correlativo_del, 0) }} al {{ nfp($envioFiscal->correlativo_al, 0) }} Sin Serie, Libro
                {{ $envioFiscal->libro }} Folio {{ $envioFiscal->folio }} SECRETARÍA DE
                BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA NIT 3377881
            </td>
            <td style="width: 15%; border: none; text-align: center;"></td>
        </tr>
        <tr>
            <td  colspan="3" style="padding-top: 1.5rem;width: 100%; border: none; text-align: center; color: #cd0303; font-weight: bold; vertical-align: middle;font-size: 12px;">
                {{ $textoFooter }}
            </td>
        </tr>
    </table>
</footer>
</body>
</html>
