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
            <span style="margin-left: 9.5cm; font-weight: 600;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">TARJETA DE RESPONSABILIDAD DE ACTIVOS FIJOS</span><br>
            <div style="margin-top: 0.35cm"></div>
        </span>
    </div>

    <div style="margin-top: 1.15cm;">
        <table style="width: 100%">
                <tr style="">
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        NOMBRE:
                    </td>
                    <td style="width:7%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        {{$activoTarjeta->responsable->nombre_completo}}
                    </td>
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        TIPO:
                    </td>
                    <td style="width:5%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">

                    </td>
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        DEPARTAMENTO:
                    </td>
                    <td style="width:5%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        {{$activoTarjeta->responsable->unidad->nombre}}
                    </td>
                </tr>
                <tr style="">
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        CARGO:
                    </td>
                    <td style="width:7%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        {{$activoTarjeta->responsable->puesto->nombre ?? ''}}
                    </td>
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        RENGLON:
                    </td>
                    <td style="width:5%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">

                    </td>
                    <td style="width:1%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        NIT:
                    </td>
                    <td style="width:5%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        {{$activoTarjeta->responsable->nit ?? ''}}
                    </td>
                </tr>
        </table>
    </div>

    <div style="margin-top: 1.15cm;">
        <table class="@if(!$activoTarjeta->tieneDetallesImpresos()) table table-bordered @endif table-sm"  style="font-size: 14px;" >
            <thead>
                <tr style="text-align: center;@if(!$activoTarjeta->tieneDetallesImpresos()) background-color: #DCDCDC;@endif  " class="py-0">
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif" rowspan="2">NO.</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif" rowspan="2">DESCRIPCIÓN DEL BIEN</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif" rowspan="2">NO. DE BIEN</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif" colspan="3">VALOR</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">FIRMA DE</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">FECHA</th>
                </tr>
                <tr style="text-align: center;@if(!$activoTarjeta->tieneDetallesImpresos()) background-color: #DCDCDC;@endif  " class="py-0">
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">ALZA</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">BAJA</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">SALDO</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">RECIBIDO</th>
                    <th style="border-color: black;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">ASIGNACION</th>
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
                    <td style="border-color: black; width: 4%; text-align: center;@if($det->impreso) opacity: 0.0; @endif" class="py-0">
                        {{$i+1}}
                    </td>
                    <td style="border-color: black; width: 46%;@if($det->impreso) opacity: 0.0; @endif" class="py-0">
                        {{$det->activo->descripcion}}
                    </td>
                    <td style="border-color: black;@if($det->impreso) opacity: 0.0; @endif " class="py-0">
                        {{$det->activo->codigo_inventario}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;@if($det->impreso) opacity: 0.0; @endif" class="py-0">
                        {{dvs().nfp($det->valor_alza)}}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;@if($det->impreso) opacity: 0.0; @endif" class="py-0">
                        {{dvs().nfp($det->valor_baja)}}
                    </td>
                    <td style="border-color: black; width: 10%; text-align: center;@if($det->impreso) opacity: 0.0; @endif" class="py-0">
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
                    <span style="font-size: 0.8em;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        <span style="font-weight: 600">OBSERVACIONES</span><br>
                        <div style="margin-top: 0.35cm"></div>
                    </span>
            </div>

            <table style="width: 100%">
                <tr style="">
                    <td style="width:8%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        (f). EMPLEADO RESPONSABLE
                    </td>
                    <td style="width:7%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        ____________________________________________________________
                    </td>
                    <td style="width:2%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
                        Vo. Bo.
                    </td>
                    <td style="width:5%;@if($activoTarjeta->tieneDetallesImpresos()) opacity: 0.0; @endif">
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
