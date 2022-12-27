<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $compra->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body style="width: 100%;">

<div>
        <span style="font-size: 1.4em">
            <div style="margin-top: 0.35cm"></div>
        </span>
</div>

<div style="margin-top: 1.15cm; font-size: 14px">
    <table class="table table-borderless table-sm" style="width: 100%">
        <tr style="">
            <td style="width:58%; vertical-align: middle; padding-left: 90px">
                Secretaría Ejecutiva de la ICMSJ
            </td>
            <td style="width:15%;">

            </td>
            <td style="width:1%; vertical-align: middle; text-align: left">
                Número
            </td>
            <td style="width:25%; font-size: 11px" colspan="2">
                <b>
                    Serie: {{ $compra->serie }}
                    <br>
                     No. &nbsp;{{ $compra->numero }}
                </b>
            </td>
        </tr>
        <tr style="">
            <td style="width:50%; padding-left: 90px">
                Secretaría Ejecutiva de la ICMSJ
            </td>
            <td style="width:15%;">

            </td>
            <td style="width:1%;">
                Fecha:
            </td>
            <td style="width:15%;">
                {{ fechaLtn($compra->fecha_documento) }}
            </td>
        </tr>
        <tr style="">
            <td style="width:5%; padding-left: 90px">
                {{strtoupper($compra->proveedor->razon_social)}} / NIT: {{$compra->proveedor->nit}}
            </td>
            <td style="width:5%;">

            </td>
            <td style="width:15%;">
                Orden de C.
            </td>
            <td style="width:15%;">
                {{ $compra->orden_compra }}
            </td>
        </tr>
    </table>
</div>

<div>
    <table class="">
        <thead>
        <tr style="text-align: center; font-size: 12px" class="py-0">
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                Cantidad
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                Descripción del articulo
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                CODIGO DEL GASTO RENGLON
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                Folio Libro Almacen
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                PRECIO POR UNIDAD
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                VALOR TOTAL
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                Folio libro inventario
            </th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle; line-height: 14px;color: white">
                NOMENCLA TURA DE CUENTAS
            </th>
        </tr>
        </thead>
        <tbody>
            @foreach($compra->compra1h->detalles as $i => $det)
                <tr style="">
                    <td style="border-color: black; width: 1.18cm; text-align: center; padding: 5px; font-size: small" class="py-0">
                        {{nf($det->cantidad)}}
                    </td>
                    <td style="border-color: black; width: 6.2cm; text-align: left; padding: 5px; font-size: small" class="py-0">
                        <span style="margin-left: 10px">
                            {{strtoupper($det->item->nombre)}}
                        </span>
                    </td>
                    <td style="border-color: black; width: 1.85cm; text-align: center; padding: 5px; font-size: small" class="py-0">
                        {{$det->item->renglon->numero}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center; padding: 5px; font-size: small" class="py-0">
                        {{ $compra->folio_almacen ?? '' }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: right; padding: 6px; font-size: small" class="py-0">
                        {{dvs().nfp($det->precio)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: right; padding: 5px; font-size: small" class="py-0">
                        {{dvs().nfp($det->sub_total)}}
                    </td>
                    <td style="border-color: black; width: 7%; padding: 5px; text-align: right; font-size: small" class="py-0">
                        {{ $compra->folio_inventario ?? ''}}
                    </td>
                    <td style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">

                    </td>
                </tr>
            @endforeach

            @foreach($compra->compra1h->detalles as $i => $det)
            @endforeach
            @php
                $total = 0;
                foreach ($compra->compra1h->detalles as $i => $det) {
                    $total = $total + $det->sub_total;
                }

                $currency = new stdClass();

                $currency->plural = 'QUETZALES';
                $currency->singular = 'QUETZAL';
                $currency->centPlural = 'CENTAVOS';
                $currency->centSingular = 'CENTAVO';

                $totalTexto = numALetrasConmoneda($total, $currency);

            @endphp

            <tr >
                <td colspan="20" style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">
                    &nbsp;
                </td>
            </tr>
            <tr >
                <td colspan="20" style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">
                    &nbsp;
                </td>
            </tr>
            <tr >
                <td colspan="20" style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">
                    &nbsp;
                </td>
            </tr>
            <tr >
                <td colspan="5" style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">
                    {{$totalTexto}}
                </td>
                <td style="border-color: black; border-top-style: solid; border-bottom-style: double; vertical-align: middle;
                width: 10%; text-align: right; font-size: 11px" class="py-0">
                    {{dvs().nf($total)}}
                </td>
                <td style="border-color: black; width: 8%;  text-align: center; padding: 5px; font-size: small" class="py-0">

                </td>
            </tr>
        </tbody>
    </table>

    <br><br><br>

</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

<script src="{{asset('js/numeros_a_letras.js')}}"></script>
</html>
