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

<div>
    <span style="font-size: 1.4em">
{{--        <span style="margin-left: 9.5cm; font-weight: 600">Libro Almacen</span><br>--}}
        <div style="margin-top: 0.35cm"></div>
    </span>
</div>

{{-- EL ROWSPAN SE TIENE QUE HACER UN COUNT DEL LIST DE LOS ITEMS + 1, ASI SE MOSTRARA CORRECTAMENTE--}}
<div style="margin-top: 1.15cm;">
    @php
        $saldo = 0;
    @endphp

    @foreach($kardex as  $folio => $datalles )

        <table class="">
            <thead style="color: white">
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

                <tr class="text-sm" style="font-size: 12px">
                    <td style="width: 7.6%">{{fechaLtn($det->created_at)}}</td>
                    <td class="text-uppercase" style="width: 6.00%">{{$det->ingreso ? $det->codigo : ''}}</td>
                    <td class="text-uppercase" style="width: 6.80%">{{$det->salida ? $det->codigo : ''}}</td>
                    <td class="text-uppercase" style="width: 15.20%">{{$det->responsable}}</td>
                    <td style="width: 6.40%">{{$det->ingreso}}</td>
                    <td style="width: 6.00%">{{$det->ingreso ? nfp($det->precio) : ''}}</td>
                    <td style="width: 8.80%">{{$det->ingreso ? nfp($det->precio * $det->ingreso) : ''}}</td>
                    <td style="width: 6.00%">{{$det->salida}}</td>
                    <td style="width: 6.40%">{{$det->salida ? nfp($det->precio) : $det->salida}}</td>
                    <td style="width: 9.20%">{{$det->salida ? nfp($det->precio * $det->salida) : ''}}</td>

                    @php
                        $saldo+=$det->ingreso-=$det->salida
                    @endphp
                    <td style="width: 6.40%" class="{{$loop->last ? 'text-bold' :''}}">
                        {{$saldo}}
                    </td>
                    <td style="width: 6.80%">{{nfp($det->precio)}}</td>
                    <td style="width: 8.40%">{{nfp($det->precio * $saldo)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
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


