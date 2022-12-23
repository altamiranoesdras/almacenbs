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
            <td style="width:50%; vertical-align: middle; padding-left: 90px">
                Secretaría Ejecutiva de la ICMSJ
            </td>
            <td style="width:15%;">

            </td>
            <td style="width:1%; vertical-align: middle">
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
    <table class="table table-borderless table-sm">
        <thead>
        <tr style="text-align: center; font-size: small; text-align: center" class="py-0">
            <th style="border-color: black; font-weight: normal; vertical-align: middle">Cantidad</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">Descripción del articulo</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">CODIGO DEL GASTO RENGLON</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">Folio Libro Almacen</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">PRECIO POR UNIDAD</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">VALOR TOTAL</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">Folio libro inventario</th>
            <th style="border-color: black; font-weight: normal; vertical-align: middle">NOMENCLA TURA DE CUENTAS</th>
        </tr>
        </thead>
        <tbody>
            @foreach($compra->compra1h->detalles as $i => $det)
                <tr>
                    <td style="border-color: black; width: 5%; text-align: center; font-size: medium" class="py-0">
                        {{nf($det->cantidad)}}
                    </td>
                    <td style="border-color: black; width: 36%; text-align: left; font-size: medium" class="py-0">
                        {{$det->item->nombre}} {{dvs().nfp($det->precio)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: center; font-size: medium" class="py-0">
                        {{$det->item->renglon->numero}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center; font-size: medium" class="py-0">
                        {{ $det->folio_almacen ?? 0 }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: right; font-size: medium" class="py-0">
                        {{dvs().nfp($det->precio)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: right; font-size: medium" class="py-0">
                        {{dvs().nfp($det->sub_total)}}
                    </td>
                    <td style="border-color: black; width: 15%;  text-align: center; font-size: medium" class="py-0">
                        {{ $det->folio_inventario ?? 0}}
                    </td>
                    <td style="border-color: black; width: 8%;  text-align: center; font-size: medium" class="py-0">

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br>
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
    <table class="table table-sm">
        <thead>
        <tr style="text-align: center; font-size: small; text-align: center" class="py-0">
{{--            <th style="borhder-color: black; font-weight: normal">Cantidad</th>--}}
        </tr>
        </thead>
        <tbody>
        <tr style="">
            <td style="border-top-style: none; width: 6%; text-align: left; font-size: small" class="py-0">
            </td>
            <td id="celdaTotalLetras" style="border-top-style: none; width: 44%; text-align: left; font-size: small" class="py-0">
                {{$totalTexto}}
            </td>
            <td style="border-top-style: none; width: 20%; text-align: left; font-size: small" class="py-0">
            </td>
            <td style="border-color: black; border-top-style: solid; border-bottom-style: double; width: 10%; text-align: center; font-size: small" class="py-0">
                {{dvs().nf($total)}}
            </td>
            <td style="border-top-style: none; width: 35%; text-align: left; font-size: small" class="py-0">
            </td>
        </tr>
        </tbody>
    </table>
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
