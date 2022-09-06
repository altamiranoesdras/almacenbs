<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $activoTarjeta->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
</head>

<body style="width: 100%;">

    <div>
        <span style="font-size: 1.4em">
            <span style="margin-left: 9.5cm; font-weight: 600">TARJETA DE RESPONSABILIDAD DE ACTIVOS FIJOS</span><br>
            <div style="margin-top: 0.35cm"></div>
        </span>
    </div>

    <div style="margin-top: 1.15cm;">
        <table style="width: 100%">
                <tr style="">
                    <td style="width:1%;">
                        NOMBRE:
                    </td>
                    <td style="width:7%;">
                        {{$activoTarjeta->responsable->name}}
                    </td>
                    <td style="width:1%;">
                        TIPO:
                    </td>
                    <td style="width:5%;">
                        ________________________
                    </td>
                    <td style="width:1%;">
                        DEPARTAMENTO:
                    </td>
                    <td style="width:5%;">
                        {{$activoTarjeta->responsable->unidad->nombre}}
                    </td>
                </tr>
                <tr style="">
                    <td style="width:1%;">
                        CARGO:
                    </td>
                    <td style="width:7%;">
                        {{$activoTarjeta->responsable->puesto->nombre}}
                    </td>
                    <td style="width:1%;">
                        RENGLON:
                    </td>
                    <td style="width:5%;">
                        ________________________
                    </td>
                    <td style="width:1%;">
                        NIT:
                    </td>
                    <td style="width:5%;">
                        ________________________________
                    </td>
                </tr>
        </table>
    </div>

    <div style="margin-top: 1.15cm;">
        <table class="table table-bordered table-sm" >
            <thead>
                <tr style="text-align: center; background-color: #DCDCDC;  " class="py-0">
                    <th style="border-color: black;" rowspan="2">NO.</th>
                    <th style="border-color: black;" rowspan="2">DESCRIPCIÓN DEL BIEN</th>
                    <th style="border-color: black;" rowspan="2">NO. DE BIEN</th>
                    <th style="border-color: black;" colspan="3">VALOR</th>
                    <th style="border-color: black;">FIRMA DE</th>
                    <th style="border-color: black;">FECHA</th>
                </tr>
                <tr style="text-align: center; background-color: #DCDCDC;  " class="py-0">
                    <th style="border-color: black;">ALZA</th>
                    <th style="border-color: black;">BAJA</th>
                    <th style="border-color: black;">SALDO</th>
                    <th style="border-color: black;">RECIBIDO</th>
                    <th style="border-color: black;">ASIGNACION</th>
                </tr>
            </thead>
            <tbody >
                @php
                    $saldo = 0;
                @endphp
                @foreach($activoTarjeta->detalles as $i => $det)
                     @php
                         if ($det->valor_alza){
                            $saldo += $det->valor_alza;
                         }

                         if ($det->valor_baja){
                            $saldo -= $det->valor_baja;
                         }

                     @endphp
                <tr style="">
                    <td style="border-color: black; width: 4%; text-align: center;" class="py-0">
                        {{$i+1}}
                    </td>
                    <td style="border-color: black; width: 46%"class="py-0">
                        {{$det->activo->descripcion}}
                    </td>
                    <td style="border-color: black; "class="py-0">
                        {{$det->activo->codigo_inventario}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                        {{dvs().nfp($det->valor_alza)}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                        {{dvs().nfp($det->valor_baja)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                        {{dvs().nfp($saldo)}}
                    </td>

                    <td style="border-color: black; width: 10%; text-align: center;" class="py-0">

                    </td>

                    <td style="border-color: black; width: 10%; text-align: center;" class="py-0">

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <div style="margin-top: 1.15cm;">

            <div>
                    <span style="font-size: 0.8em">
                        <span style="font-weight: 600">OBSERVACIONES</span><br>
                        <div style="margin-top: 0.35cm"></div>
                    </span>
            </div>

            <table style="width: 100%">
                <tr style="">
                    <td style="width:8%;">
                        (f). EMPLEADO RESPONSABLE
                    </td>
                    <td style="width:7%;">
                        ____________________________________________________________
                    </td>
                    <td style="width:2%;">
                        Vo. Bo.
                    </td>
                    <td style="width:5%;">
                        ____________________________________________________________
                    </td>
                </tr>
            </table>
        </div>
    </footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>
