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


    @php
        $borde = 0;
        $conteoLineas = 0;
        $maximoLineas = 14;
    @endphp


        @foreach($listadoCompras->sortBy('fecha_ingreso') as $compra)
            @php
                if ( ($conteoLineas + $compra->detalles->count()) > $maximoLineas && $loop->index > 0 ) {
                    $conteoLineas = 0;
                    echo '<div style="page-break-after:always;"></div>';
                }

                if ( $compra->id == 27) {
                    $conteoLineas = 0;
                    echo '<div style="page-break-after:always;"></div>';
                }
            @endphp
    {{--        table table-bordered--}}
            <table border="{{$borde}}" style="width: 100%; font-size: 11px;" >

                <tbody>
                    <tr style="">
                        <td style="width: 18mm; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                            {{ fechaLtn($compra->fecha_ingreso) }}
                        </td>
                        <td style="width: 18mm; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                            Serie: {{ $compra->serie }}
                            <br>
                            No. {{ $compra->numero }}
                        </td>
                        <td style="width: 16mm; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                            {{ fechaLtn($compra->fecha_documento) }}
                        </td>
                        <td style="width: 44mm; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                            {{ $compra->proveedor->nombre }}
                        </td>
                        <td style="width: 20mm; text-align: center; vertical-align: middle;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                            {{ $compra->proveedor->nit }}
                        </td>
                    </tr>
                    @foreach($compra->detalles as $detalle)
                        @php
                            $conteoLineas ++;
                        @endphp
                        <tr>
                            <td style="width: 56mm;" class="py-0 pl-2">
                                {{ $detalle->item->texto_libro_almacen }}
                            </td>
                            <td style="width: 22mm; text-align: center;" class="py-0 text-center">
                                {{ nf( $detalle->cantidad,0 ) }}
                            </td>
                            <td style="width: 21mm; text-align: center;" class="py-0 text-right pr-2">
                                {{ dvs().nfp( $detalle->precio ) }}
                            </td>
                            <td style="width: 24mm; text-align: center;" class="py-0 text-right pr-2">
                                {{ dvs().nfp( $detalle->sub_total ,2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="vertical-align: middle;" class="pl-2">
                            <b class="pull-left">SUB TOTAL</b>
                        <td></td>
                        <td></td>
                        <td class="text-right px-2">
                            <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
                            {{ dvs().nfp( $compra->detalles->sum('sub_total'),2 ) }}
                            <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px;"></div>
                            <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="20" style="height: 2mm"></td>
                    </tr>
                </tbody>
            </table>

        @endforeach

    <table border="{{$borde}}" style="width: 100%; font-size: 11px;" >
        <tr>
            <td style="width: 116mm; text-align: center; vertical-align: middle;"></td>
            <td style="width: 56mm; vertical-align: middle;" class="pl-2">
                <b class="pull-left">TOTAL MES {{mb_strtoupper(mesLetras($mes))}}</b>
            </td>
            <td style="width: 22mm; text-align: center;" class="py-0 text-center">

            </td>
            <td style="width: 21mm; text-align: center;" class="py-0 text-right pr-2">

            </td>
            <td style="width: 24mm; text-align: center;" class="py-0 text-right pr-2">
                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
                {{ dvs().nfp( $listadoCompras->sum('total'),2 ) }}
                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 2px;"></div>
                <div style="border-bottom: 1px solid black; margin-top: 0; margin-bottom: 0;"></div>
            </td>
        </tr>

    </table>


</body>


</html>
