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


<div style="margin-top: 1.15cm;">
    @php
        $encabezdosYBorde = 1;
        $saldo = 0;
    @endphp

    @foreach($kardex as  $folio => $datalles )

        @php
            $primerDetalle = $datalles->first();
        @endphp
        <table style="width: 100%" border="{{$encabezdosYBorde}}">
            <tr style="font-size: 12px; text-align: center;">
                <td></td>
                <td>{{$primerDetalle->codigo_insumo}}</td>
                <td></td>
                <td></td>
                <td colspan="5">
                    {!! $primerDetalle->item->texto_kardex  !!}
                </td>
                <td></td>
                <td>{{$primerDetalle->del}}</td>
                <td></td>
                <td>{{$primerDetalle->al}}</td>
            </tr>
        </table>
        <br>
        <table  style="width: 100%;" border="{{$encabezdosYBorde}}" >
            <thead style="color: {{$encabezdosYBorde ? 'black' : 'white'}}">
            <tr class="text-center">
                <th rowspan="2">Fecha</th>
                <th colspan="2">DOCUMENTO NO.</th>
                <th rowspan="2">Nombre Solicitante</th>
                <th colspan="3">Entradas</th>
                <th colspan="3">Salidas</th>
                <th colspan="3">Existencias</th>
            </tr>
            <tr class="text-center">
                <th>Forma 1H</th>
                <th>Requisición</th>
                <th>Cantidad</th>
                <th>P.U.</th>
                <th>Valor Total</th>
                <th>Cantidad</th>
                <th>P.U.</th>
                <th>Valor Total</th>
                <th>Cantidad</th>
                <th>P.U.</th>
                <th>Valor Total</th>
            </tr>
            </thead>
            <tbody>



            @foreach($datalles as  $det )

                <tr style="font-size: 12px; text-align: center;">
                    <td style="width: 5.53%">{{fechaLtn($det->created_at)}}</td>
                    <td class="text-uppercase" style="width: 5.93%">{{$det->ingreso ? $det->codigo : ''}}</td>
                    <td class="text-uppercase" style="width: 6.72%">{{$det->salida ? $det->codigo : ''}}</td>
                    <td class="text-uppercase" style="width: 15.81%">{{$det->responsable}}</td>
                    <td style="width: 6.32%">{{$det->ingreso}}</td>
                    <td style="width: 6.32%">{{$det->ingreso ? nfp($det->precio) : ''}}</td>
                    <td style="width: 8.70%">{{$det->ingreso ? nfp($det->precio * $det->ingreso,2) : ''}}</td>
                    <td style="width: 5.93%">{{$det->salida}}</td>
                    <td style="width: 6.72%">{{$det->salida ? nfp($det->precio) : $det->salida}}</td>
                    <td style="width: 9.49%">{{$det->salida ? nfp($det->precio * $det->salida,2) : ''}}</td>

                    @php
                        $saldo+=$det->ingreso-=$det->salida
                    @endphp
                    <td style="width: 6.72%" class="{{$loop->last ? 'text-bold' :'000-xxx'}}">
                        {{$saldo}}
                    </td>
                    <td style="width: 6.72%">{{nfp($det->precio)}}</td>
                    <td style="width: 9.09%">{{nfp($det->precio * $saldo,2)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>

</body>


</html>


