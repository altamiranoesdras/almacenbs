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
    $fechaFinEncabezdos = 0;
    $borde = 0;
    $saldo = 0;
    $totalIngreso=0;
    $totalEgreso=0;

@endphp

@foreach($folios as  $folio => $datalles )

    @php
        $primerDetalle = $datalles->first();

        $anchoFecha = 24;
        $anchoConcepto = 91;
        $anchoEntradaCantidad = 26;
        $anchoSalidaCantidad = 26;
        $anchoPrecioUnitario = 26;
        $anchoSaldoCantidad = 29;
        $anchoEntradasValor = 26;
        $anchoSalidasValor = 25;
        $anchoSaldoValor = 25;

        $totalAnchos = $anchoFecha + $anchoConcepto + $anchoEntradaCantidad + $anchoSalidaCantidad +
            $anchoPrecioUnitario + $anchoSaldoCantidad + $anchoEntradasValor + $anchoSalidasValor + $anchoSaldoValor;

        $imprimeEncabezado = $primerDetalle->impreso ? '1' : '0';

    @endphp



    <table style="margin-bottom: 1cm; width: 100%;color: {{$imprimeEncabezado ? 'black' : 'white'}}" border="0">
        <tr style="font-size: 12px; text-align: left;">
            <td >
                Articulo: <span class="text-uppercase">{!! $primerDetalle->item->texto_kardex  !!}</span>
            </td>
            <td style="text-align: right;">
                UNIDAD DE MEDIDA: {{ $primerDetalle->item->unimed->nombre ?? '' }}
            </td>
        </tr>
{{--        <tr style="font-size: 12px; text-align: left;">--}}
{{--            <td colspan="2">--}}
{{--                COORDINACION: OFICINAS CENTRALES, CENTROS Y PROGRAMAS DE LA S.B.S.--}}
{{--            </td>--}}
{{--        </tr>--}}
    </table>



    <table style="width: 100%;" border="{{$imprimeEncabezado}}">


        <tr class="text-center" style="font-size: 12px; text-align: center; color: {{$imprimeEncabezado ? 'black' : 'white'}}">
            <th rowspan="2" style="width: {{$anchoFecha}}mm">FECHA DE INGRESO Y EGRESO</th>
            <th rowspan="2" style="width: {{$anchoConcepto}}mm">CONCEPTO</th>
            <th colspan="3" class="text-center">UNIDADES FÍSICAS</th>
            <th colspan="5" class="text-center">VALOR Q.</th>
        </tr>
        <tr class="text-center" style="font-size: 11px; text-align: center; color: {{$imprimeEncabezado ? 'black' : 'white'}}">
            <th style="width: {{$anchoEntradaCantidad}}mm">ENTRADA</th>
            <th style="width: {{$anchoSalidaCantidad}}mm">SALIDA</th>
            <th style="width: {{$anchoSaldoCantidad}}mm">EXISTENCIA</th>
            <th style="width: {{$anchoPrecioUnitario}}mm">PRECIO UNITARIO</th>
            <th style="width: {{$anchoEntradasValor}}mm">ENTRADAS</th>
            <th style="width: {{$anchoSalidasValor}}mm">SALIDAS</th>
            <th style="width: {{$anchoSaldoValor}}mm">EXISTENCIAS</th>
        </tr>

        @foreach($datalles as  $il => $det )

            @php
//                $saldo += $det->ingreso -= $det->salida;
                $totalIngreso += $det->precio * $det->ingreso;
                $totalEgreso += $det->precio * $det->salida;
                $valorEntrada = $det->ingreso ? nfp($det->precio * $det->ingreso, 2) : null;
                $valorSalida = $det->salida ? nfp($det->precio * $det->salida, 2) : null;
            @endphp

            <tr style="font-size: 11px;  text-align: center; color: {{$det->impreso ? '' : 'white'}};">

                <td style="padding-bottom: 5mm">{{ $det->fecha_ordena }}</td>
                <td style="padding-bottom: 5mm" class="text-left">{{ $det->concepto }}</td>
                <td style="padding-bottom: 5mm">{{ $det->ingreso }}</td>
                <td style="padding-bottom: 5mm">{{ $det->salida }}</td>
                <td style="padding-bottom: 5mm">{{ $det->saldo }}</td>
                <td style="padding-bottom: 5mm" class="text-bold">
                    {{ dvs().$det->precio }}
                </td>
                <td style="padding-bottom: 5mm">{{ $valorEntrada ? dvs().$valorEntrada : '' }}</td>
                <td style="padding-bottom: 5mm">{{ $valorSalida ? dvs().$valorSalida : '' }}</td>
                <td style="padding-bottom: 5mm">{{ dvs().nfp($det->saldo * $det->precio, 2) }}</td>

            </tr>

        @endforeach
    </table>
@endforeach

</body>


</html>


