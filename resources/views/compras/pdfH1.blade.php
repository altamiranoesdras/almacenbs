
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $compra->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        #tabla-detalles > tbody > tr > td {
            font-size: 12px;
        }
    </style>
</head>

<body style="width: 100%; margin-right: 0px">

<div>
        <span style="font-size: 1.4em">
            <div style="margin-top: 0.35cm"></div>
        </span>
</div>

<div style="margin-top: 1.15cm; font-size: 14px">
    <table class="table table-borderless table-sm" style="width: 100%" >
        <tr style="">
            <td style="width:70%; vertical-align: middle; padding-left: 3.5cm">
                SECRETARIA DE BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPUBLICA
            </td>
            <td style="width:14%; vertical-align: middle; text-align: left;color: white">
                Número
            </td>
            <td style="width:16%; font-size: 16px; padding-top: 0; padding-left: 1rem">
                <b>
                    {{ $compra->compra1h->folio ?? "" }}
                </b>
            </td>
        </tr>
        <tr style="">
            <td style="width:70%; padding-left: 3.5cm">
                {{--                 SECRETARIA DE BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPUBLICA--}}
            </td>
            <td style="width:10%;color: white">
                Fecha:
            </td>
            <td style="width:18%;">
                <span style="margin-left: 0">{{ fechaLtn($compra->fecha_ingreso) }}</span>
            </td>
        </tr>
        <tr style="">
            <td style="width:70%; padding-left: 3.5cm; font-size: 12px">
                {{strtoupper($compra->proveedor->nombre)}} / NIT: {{$compra->proveedor->nit}}
            </td>
            <td style="width:10%;color: white">
                Orden de C.
            </td>

            <td style="width:18%; padding-left: 2.5cm" >
                {{--                {{ $compra->orden_compra ?? "" }}--}}
            </td>
        </tr>
    </table>
</div>

<div>
    <table class="" style="width: 100%" border="0" id="tabla-detalles">
        <thead>
        <tr style="text-align: center; font-size: 12px" class="">
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
                <td style="border-color: black;
                        width: 7.85%;
                        text-align: center;
                        padding-right: 7px;" class="py-0">

                    {{nf($det->cantidad,0)}}
                </td>
                <td  class="py-0 text-left"
                     style="border-color: black;
                         width: 32.63%;
                         text-align: left;
                         padding-left: 0px;">

                    {{mb_strtoupper($det->text)}}
                </td>
                <td class="" style="border-color: black;
                        width: 10.53%;
                        text-align: center;
                        padding-left: 5px;" >

                    {{$det->item->renglon->numero}}
                </td>
                <td class="py-0" style="border-color: black;
                        width: 8.95%;
                        text-align: center;
                            padding: 5px;" >
                    {!! $det->folio_almacen ?? $compra->folio_almacen ?? '' !!}
                </td>
                <td class="py-0" style="border-color: black;
                        width: 12%;
                        text-align: right;
                        padding-right: 8px;" >
                    {{dvs().nfp($det->precio)}}
                </td>
                <td class="py-0" style="border-color: black;
                        width: 11.58%;
                        text-align: right;
                        padding-right: 8px;" >
                    {{dvs().nfp($det->sub_total,2)}}
                </td>
                <td class="py-0" style="border-color: black;
                        width: 8%;
                        padding-right: 8px;
                        text-align: right;"
                >
                    {!! $det->folio_inventario ?? $compra->folio_inventario ?? '' !!}

                </td>
                <td class="py-0" style="border-color: black;
                        text-align: center;
                        padding: 5px;" >

                </td>
            </tr>
        @endforeach


        <tr >
            <td colspan="20" style="border-color: black; text-align: center; padding: 5px; font-size: small" class="py-0">
                &nbsp;
            </td>
        </tr>
        <tr >
            <td colspan="20" style="border-color: black; text-align: center; padding: 5px; font-size: small" class="py-0">
                &nbsp;
            </td>
        </tr>
        <tr >
            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>
            <td class="py-0 text-left " style="border-color: black;  text-align: center; padding: 2px; font-size: small" >
                {{--                {{$compra->compra1h->total_letras}}--}}
                TOTAL--------------------------------------------------
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                --------------
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                --------------
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                --------------
            </td>
            <td style="border-color: black;
                    vertical-align: middle;
                    text-align: right;
                    font-size: 12px;
                    padding-right: 8px;
                    padding-bottom: 0;
                    ">

                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px; margin-left: 15px"></div>

                {{dvs().nfp($compra->compra1h->total,2)}}
                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px; margin-left: 15px"></div>
                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;margin-left: 15px"></div>
            </td>
            <td class="py-0" style="border-color: black;  text-align: center; padding: 5px; font-size: small" >

            </td>

            <td style="border-color: black;  text-align: center; padding: 5px; font-size: small" class="py-0">

            </td>
        </tr>
        <tr >
            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>
            <td class="py-0 text-left " style="border-color: black;  text-align: center; padding: 2px; font-size: small" >
                {{$compra->tipo->nombre}} <br>
                Serie: {{ $compra->serie ?? '' }}<br>
                Número de DTE: {{ $compra->numero }}
                @if($compra->esFacturaCambiaria())
                    <br>
                    Recibido de caja: {{ $compra->recibo_de_caja }}
                @endif
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>

            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>
            <td class="py-0" style="border-color: black; width: 7.89%; text-align: center; padding: 5px; font-size: small" >
                &nbsp;
            </td>
            <td class="py-0" style="border-color: black;  text-align: center; padding: 5px; font-size: small" >

            </td>

            <td style="border-color: black;  text-align: center; padding: 5px; font-size: small" class="py-0">

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



