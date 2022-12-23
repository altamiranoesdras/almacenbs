<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $solicitud->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
</head>
@php
    $i=0;
@endphp

<body style="width: 100%;">
    <div>
        <table class="table table-bordered table-sm" style="margin-bottom: 0">
            <tr>
                <td style="border-top-color: black;
                        border-bottom-color: black;
                        border-left-color: black;
                        border-right-color: white" width="10%">
                    <img src="{{asset('/img/SEICMSJ-logo.jpg')}}" height="150px">
                </td>
                <td style="border-top-color: black;
                        border-bottom-color: black;
                        border-left-color: black;
                        border-right-color: white;
                        text-align: center;
                        vertical-align: middle">
                    SECRETARIA EJECUTIVA DE LA INSTANCIA COORDINADORA DE LA MODERNIZACIÓN DEL SECTOR JUSTICIA
                    <br><br>
                    REQUISICIÓN DE MATERIALES Y SUMINISTROS
                </td>
                <td style="border-color: black; padding-top: 30px" width="20%">
                    <font color="red">No. {{$solicitud->codigo}}</font>
                </td>
            </tr>
        </table>
    </div>
    <p style="margin: 0">Unidad Solicitante: {{$solicitud->unidad->nombre}}</p>
    <table style="width: 100%" border="1">
        <tr>
            <td colspan="2">Lugar y Fecha: <b>{{ fechaLtnMesEnTexto($solicitud->fecha_despacha) }}</b></td>
        </tr>
        <tr>
            <td>Nombre del Solicitante: <b>{{ $solicitud->usuarioSolicita->name }}</b></td>
        </tr>
        <tr>
            <td>Cargo: <b>{{ $solicitud->usuarioSolicita->puesto->nombre }}</b></td>
        </tr>
    </table>
    <br>
    <table class="table table-bordered table-sm">
        <thead>
            <col>
            <colgroup span="2"></colgroup>
            <colgroup span="2"></colgroup>
            <colgroup span="2"></colgroup>
            <tr>
                <td rowspan="2" style="border-color: black; vertical-align: middle;
                    text-align: center" width="40%">Nombre del Producto</td>
                <td rowspan="2" style="border-color: black; vertical-align: middle;
                    text-align: center">Unidad de Medida</td>
                <th colspan="2" scope="colgroup" style="border-color: black; vertical-align: middle;
                    text-align: center; font-weight: normal" width="80%">CANTIDAD</th>
            </tr>
            <tr>
                <th style="border-color: black; vertical-align: middle;
                    text-align: center; font-weight: normal" scope="col" width="17%">SOLICITADA</th>
                <th style="border-color: black; vertical-align: middle;
                    text-align: center; font-weight: normal" scope="col">DESPACHADA</th>
            </tr>
        </thead>
        <tbody style="margin-bottom: 0">
        @foreach ($solicitud->detalles as $detalle)
            <tr style="line-height: 20px">
                <td style="border-color: black; "class="py-0">
                    {{ $detalle->item->nombre }}
                </td>
                <td style="border-color: black; width: 16%; font-size: 0.8em;  text-align: center;" class="py-0">
                    {{ $detalle->item->unimed->nombre }}
                </td>
                <td style="border-color: black; width: 16%;  text-align: center;"class="py-0">
                    {{ $detalle->cantidad_solicitada }}
                </td>
                <td style="border-color: black; width: 16%; text-align: center;"class="py-0">
                    {{ $detalle->cantidad_despachada }}
                </td>
            </tr>
            @php
                $totalLineas = 20;
                $final = $totalLineas - $loop->iteration;
            @endphp
        @endforeach
        @for ($i = 1; $i <= $final ; $i++)
            <tr style="line-height: 20px">
                <td style="border-color: black; text-align: center; "  class="py-0">
                    <span style="color: white">1</span>
                </td>
                <td style="border-color: black; text-align:center;" class="py-0">

                </td>
                <td style="border-color: black; text-align:center; font-size: 0.6em; " class="py-0">

                </td>
                <td style="border-color: black; text-align:center;" class="py-0">

                </td>

            </tr>
        @endfor
        </tbody>
    </table>
   <b>OBSERVACIONES <span style="font-size: 14px;">(Destino del material y/o insumo)</span></b>
    <table class="table table-bordered table-sm" style="margin-bottom: 0">
        <tr>
            <td width="10%" height="85px" style="border-color: black">
                {{ $solicitud->justificacion }}
            </td>
        </tr>
    </table>
<br>
<br>
<br>
<br>
<br>
    <table style="margin-left: auto; margin-right: auto;">
        <tr>
            <td style="padding-right: 50px">
                <input type="text" class="firma" value="(f)"/>
            </td>
            <td style="padding-right: 50px">
                <input type="text" class="firma" value="(f)"/>
            </td>
            <td style="padding-right: 50px">
                <input type="text" class="firma" value="(f)"/>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 50px; text-align: center">
                <p>Firma y Sello de Recibido</p>
            </td>
            <td style="padding-right: 50px; text-align: center">
                Firma y sello Coordinadora <br>
                Administrativo <br>
                Autoriza
            </td>
            <td style="padding-right: 50px; text-align: center">
                Firma y sello Enc. Almacén de<br>
                Suministros <br>
                Entrega
            </td>
        </tr>
    </table>

</body>

<style>
    .firma {
        border: 0;
        border-bottom: 1px solid #000;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>
