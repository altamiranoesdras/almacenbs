<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kardex insumo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body style="width: 100%;">


    @php
        $encabezdos = 0;
        $borde = 0;
        $saldo = 0;
        $totalIngreso=0;
        $totalEgreso=0;

    @endphp

    @foreach($folios as  $folio => $datalles )

        @php
            $primerDetalle = $datalles->first();
            $anchos = [
               "margen_izq" => 15,
               "fecha" => 14,
               "1h" => 15.5,
               "requi" => 17,
               "solicita" => 39,
               "cant_ing" => 15.5,
               "precio_ing" => 15.5,
               "total_ing" => 21.5,
               "cant_sal" => 15.5,
               "precio_sal" => 17,
               "total_sal" => 24,
               "cant_ext" => 16,
               "precio_ext" => 17.5,
               "total_ext" => 22,
               "margen_der" => 14,
            ];

            $totalAnchos = array_sum(array_values($anchos));

            $anchoNombreProducto = $anchos['requi']+$anchos['solicita'];
            $anchoNombreProductoValor = $anchos['cant_ing']+$anchos['precio_ing']+$anchos['total_ing']+$anchos['cant_sal']+$anchos['precio_sal'];

            $prueba = $anchos['margen_izq']+$anchos['margen_der']+$anchos['fecha']+$anchos['1h']+$anchoNombreProducto+$anchoNombreProductoValor+$anchos['total_sal']+$anchos['cant_ext']+$anchos['precio_ext']+$anchos['total_ext'];


        @endphp






        <table  style="width: 100%;" border="{{$borde}}" >

            @if($imprimeEncabezado)
            <tr style="font-size: 12px; text-align: center;">

                <td style="width: {{$anchos['fecha']}}mm; vertical-align: middle; color: {{$encabezdos ? 'black' : 'white'}}">
                    {{$prueba}}
                </td>
                <td style="width: {{$anchos['1h']}}mm; text-align: center; vertical-align: middle;">
                    {{$primerDetalle->codigo_insumo}}
                </td>
                <td style="width: {{$anchoNombreProducto}}mm; text-align: center; vertical-align: middle; color: {{$encabezdos ? 'black' : 'white'}}" colspan="2" >
                    Nombre del producto
                </td>
                <td style="width: {{$anchoNombreProductoValor}}mm; text-align: center; vertical-align: middle;" colspan="5">
                    {!! $primerDetalle->item->texto_kardex  !!}
                </td>
                <td style="width: {{$anchos['total_sal']}}mm; text-align: center; vertical-align: middle; color: {{$encabezdos ? 'black' : 'white'}}">
                    Periodo del
                </td>
                <td style="width: {{$anchos['cant_ext']}}mm; text-align: center; vertical-align: middle;">
                    {{fechaLtn($primerDetalle->del)}}
                </td>
                <td style="width: {{$anchos['precio_ext']}}mm; text-align: center; vertical-align: middle; color: {{$encabezdos ? 'black' : 'white'}}">
                    al
                </td>
                <td style="width: {{$anchos['total_ext']}}mm; text-align: center; vertical-align: middle;">
                    {{fechaLtn($primerDetalle->al)}}
                </td>

            </tr>
            @endif

            <tr>
                <td colspan="20" style="color: {{$encabezdos ? 'black' : 'white'}}">
                    espacio
                </td>
            </tr>

            <tr class="text-center" style="font-size: 12px; text-align: center; color: {{$encabezdos ? 'black' : 'white'}}">
                <th rowspan="2" style="width: {{$anchos['fecha']}}mm">Fecha</th>
                <th colspan="2" >DOCUMENTO NO.</th>
                <th rowspan="2" style="width: {{$anchos['solicita']}}mm">Nombre Solicitante</th>
                <th colspan="3" >Entradas</th>
                <th colspan="3" >Salidas</th>
                <th colspan="3" >Existencias</th>
            </tr>
            <tr class="text-center" style="font-size: 12px; text-align: center; color: {{$encabezdos ? 'black' : 'white'}}">
                <th style="width: {{$anchos['1h']}}mm; font-size: 10px;">FORMA 1H</th>
                <th style="width: {{$anchos['requi']}}mm; font-size: 10px;">REQUISICIÓN</th>
                <th style="width: {{$anchos['cant_ing']}}mm">CANTIDAD</th>
                <th style="width: {{$anchos['precio_ing']}}mm">P.U.</th>
                <th style="width: {{$anchos['total_ing']}}mm">VALOR TOTAL</th>
                <th style="width: {{$anchos['cant_sal']}}mm">CANTIDAD</th>
                <th style="width: {{$anchos['precio_sal']}}mm">P.U.</th>
                <th style="width: {{$anchos['total_sal']}}mm">VALOR TOTAL</th>
                <th style="width: {{$anchos['cant_ext']}}mm">CANTIDAD</th>
                <th style="width: {{$anchos['precio_ext']}}mm">P.U.</th>
                <th style="width: {{$anchos['total_ext']}}mm">VALOR TOTAL</th>
            </tr>

            @foreach($datalles as  $il => $det )

                <!--            height: {{$il==0 ? 'auto' : '15mm'}};
                ------------------------------------------------------------------------>

                <tr style="font-size: 12px;  text-align: center; color: {{$det->impreso ? '' : 'white'}}">

                    <td >{{fechaLtn($det->created_at)}}</td>
                    <td class="text-uppercase">{{$det->ingreso ? $det->codigo : ''}}</td>
                    <td class="text-uppercase">{{$det->salida ? $det->codigo : ''}}</td>
                    <td class="text-uppercase" style="width: {{$anchos['solicita']}}mm !important;font-size: 11px; text-align: left;">
                        {{$det->responsable}}
                    </td>
                    <td >{{$det->ingreso}}</td>
                    <td >{{$det->ingreso ? nfp($det->precio) : ''}}</td>
                    <td >{{$det->ingreso ? nfp($det->precio * $det->ingreso,2) : ''}}</td>
                    <td >{{$det->salida}}</td>
                    <td >{{$det->salida ? nfp($det->precio) : $det->salida}}</td>
                    <td >{{$det->salida ? nfp($det->precio * $det->salida,2) : ''}}</td>

                    @php
                        $saldo+=$det->ingreso-=$det->salida;
                        $totalIngreso += ($det->precio * $det->ingreso);
                        $totalEgreso += ($det->precio * $det->salida);
                    @endphp
                    <td  class="{{$loop->last ? 'text-bold' :'000-xxx'}}">
                        {{$det->saldo_stock}}

                    </td>
                    <td >{{nfp(($det->precio_existencia ?? $det->precio))}}</td>
                    <td >
{{--                        @php--}}
{{--//                            $total = $totalIngreso > 0 ? $totalIngreso-$totalEgreso : $totalEgreso;--}}
{{--                            $total = $saldo * ($det->precio_existencia ?? $det->precio);--}}
{{--                        @endphp--}}
{{--                        {{nfp($total,2)}}--}}
                        {{nfp($det->sub_total_saldo)}}

                    </td>
                </tr>

                <tr style="height: 7mm">
                    <td colspan="50">
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach

</body>


</html>


