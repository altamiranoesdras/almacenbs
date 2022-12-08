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
{{--            <span style="margin-left: 9.5cm; font-weight: 600">TARJETA DE RESPONSABILIDAD DE ACTIVOS FIJOS</span><br>--}}
            <div style="margin-top: 0.35cm"></div>
        </span>
</div>

<div style="margin-top: 1.15cm;">
    <table class="table table-bordered table-sm" style="width: 100%">
        <tr style="">
            <td style="width:1%;">
                DEPENDENCIA:
            </td>
            <td style="width:15%;">

            </td>
            <td style="width:1%;">
                NUMERO:
            </td>
            <td style="width:15%;">
                {{ $compra->serie }} - {{ $compra->numero }}
            </td>
        </tr>
        <tr style="">
            <td style="width:1%;">
                PROGRAMA:
            </td>
            <td style="width:15%;">

            </td>
            <td style="width:1%;">
                FECHA:
            </td>
            <td style="width:15%;">
                {{ fechaLtn($compra->created_at) }}
            </td>
        </tr>
        <tr style="">
            <td style="width:5%;">
                PROVEEDOR:
            </td>
            <td style="width:5%;">
                {{ $compra->proveedor->nombre }}
            </td>
            <td style="width:5%;">
                ORDEN DE C. Y P. No:
            </td>
            <td style="width:15%;">
                {{ $compra->orden_compra }}
            </td>
        </tr>
    </table>
</div>

<div style="margin-top: 1.15cm;">
    <table class="table table-bordered table-sm">
        <thead>
        <tr style="text-align: center;" class="py-0">
            <th style="border-color: black;">CANTIDAD</th>
            <th style="border-color: black;">DESCRIPCIÓN DEL ARTICULO</th>
            <th style="border-color: black;">CODIGO DEL GASTO RENGLO</th>
            <th style="border-color: black;">FOLIO LIBRO ALMACEN</th>
            <th style="border-color: black;">PRECIO POR UNIDAD</th>
            <th style="border-color: black;">VALOR TOTAL</th>
            <th style="border-color: black;">FOLIO LIBRO INVENTARIO</th>
            <th style="border-color: black;">NOMENCALTURA DE CUENTAS</th>
        </tr>
        </thead>
        <tbody>
        {{--        @php--}}
        {{--            $saldo = 0;--}}
        {{--        @endphp--}}
            @foreach($compra->compra1h->detalles as $i => $det)
{{--                @php--}}
{{--                    if ($det->valor_alza){--}}
{{--                       $saldo += $det->valor_alza;--}}
{{--                    }--}}
{{--    --}}
{{--                    if ($det->valor_baja){--}}
{{--                       $saldo -= $det->valor_baja;--}}
{{--                    }--}}
{{--    --}}
{{--                @endphp--}}
                <tr style="">
                    <td style="border-color: black; width: 4%; text-align: center;" class="py-0">
                        {{nf($det->cantidad)}}
                    </td>
                    <td style="border-color: black; width: 46%; text-align: center;" class="py-0">
                        {{$det->item->nombre}}
                    </td>
                    <td style="border-color: black; text-align: center;" class="py-0">
                        {{$det->item->renglon->numero}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                        {{ $det->folio_almacen }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                        {{dvs().nfp($det->precio)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                        {{dvs().nfp($det->sub_total)}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                        {{ $det->folio_inventario }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">

                    </td>
                </tr>
            @endforeach
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
</html>
