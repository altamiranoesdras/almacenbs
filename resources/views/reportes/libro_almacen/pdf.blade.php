<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro Almacen Mes {{ $request->get('mes') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body style="width: 100%;">

<div>
    <span style="font-size: 1.4em">
{{--        <span style="margin-left: 9.5cm; font-weight: 600">Libro Almacen</span><br>--}}
        <div style="margin-top: 0.35cm"></div>
    </span>
</div>

{{-- EL ROWSPAN SE TIENE QUE HACER UN COUNT DEL LIST DE LOS ITEMS + 1, ASI SE MOSTRARA CORRECTAMENTE--}}
<div style="margin-top: 1.15cm;">
    @php
        $conteoLineas = 0;
        $conteoDetalles = 0;
        $maximoLineas = 20;
    @endphp
    @foreach($listadoCompras as $compra)
        @php
            if ( ($conteoLineas + $compra->detalles->count()) > $maximoLineas && $loop->index > 0 ) {
                $conteoLineas = 0;
                echo '<div style="page-break-after:always;"></div>';
            }
        @endphp
{{--        table table-bordered--}}
        <table class="  table-sm" >
            <tbody>
                <tr style="">
                    <td style="width: 8%; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ fechaLtn($compra->fecha_ingreso) }}
                    </td>
                    <td style="width: 8%; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        Serie: {{ $compra->serie }}
                        <br>
                        No. {{ $compra->numero }}
                    </td>
                    <td style="width: 8%; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ fechaLtn($compra->fecha_documento) }}
                    </td>
                    <td style="width: 15%; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->proveedor->nombre }}
                    </td>
                    <td style="width: 5%; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->proveedor->nit }}
                    </td>
                </tr>
                @foreach($compra->detalles as $detalle)
                    @php
                        $conteoLineas ++;
                    @endphp
                    <tr>
                        <td style="width: 20%;" class="py-0">
{{--                            {{ $compra->id }} ---}}
{{--                            {{ $detalle->id }} ---}}
{{--                            {{ $conteoLineas }} ---}}
                            {{ $detalle->item->texto_principal }}
                        </td>
                        <td style="width: 5%; text-align: center;" class="py-0">
                            {{ nf( $detalle->cantidad ) }}
                        </td>
                        <td style="width: 5%; text-align: center;" class="py-0">
                            {{ dvs().nf( $detalle->precio ) }}
                        </td>
                        <td style="width: 5%; text-align: center;" class="py-0">
                            {{ dvs().nf( $detalle->sub_total ) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align: middle;">
                        <b class="pull-left">SUB TOTAL</b>
                    <td></td>
                    <td></td>
                    <td style="">
                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
                        {{ dvs().nf( $compra->total_venta ) }}
                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px;"></div>
                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="20">&nbsp;</td>
                </tr>
            </tbody>
{{--            <tfoot >--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td style="vertical-align: middle;">--}}
{{--                        <b class="pull-left">SUB TOTAL</b>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td style="">--}}
{{--                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>--}}
{{--                        {{ dvs().nf( $compra->total_venta ) }}--}}
{{--                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px;"></div>--}}
{{--                        <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            </tfoot>--}}
        </table>
{{--        <div style="page-break-after:always;"></div>--}}
    @endforeach
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</html>
