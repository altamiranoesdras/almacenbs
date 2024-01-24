<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $consumo->codigo }}</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}" >

    <style>
        body{
            width: 100%;
            font-size: 12px;
        }
    </style>
</head>


<body>



@php
    $maximoLineas = 20;
@endphp

<table>
    <tr>
        <td style="width: 20%">
            <img src="{{asset('img/SEICMSJ-logo.jpg')}}" alt="logo" width="100px">
        </td>
        <td style="width: 60%" class="text-center">
            SECRETARIA EJECUTIVA DE LA INSTANCIA COORDINADORA DE LA MODERNIZACIÓN DEL SECTOR JUSTICIA
        </td>
        <td style="width: 20%" class="text-danger text-sm" >
           No. {{$consumo->codigo}}
        </td>
    </tr>

    <tr>
        <td colspan="3" class="text-center">
            REQUISICIÓN DE MATERIALES Y SUMINISTROS
        </td>
    </tr>

    <tr>
        <td colspan="3" class="text-center">
            CAJ {{$consumo->bodega->nombre}}
        </td>
    </tr>

</table>


<br>


<table border="1" style="width: 100%">
    <tr>
        <td style="width: 30%">
            Lugar y Fecha:
        </td>
        <td style="width: 70%">
            <b>{{$consumo->created_at->format('d/m/Y')}}</b>
        </td>
    </tr>
    <tr>
        <td style="width: 30%">
            Nombre del solicitante:
        </td>
        <td style="width: 70%">
            <b>{{$consumo->usuarioCrea->name}}</b>
        </td>
    </tr>
    <tr>
        <td style="width: 30%">
            Cargo:
        </td>
        <td style="width: 70%">
            <b>{{$consumo->usuarioCrea->puesto->nombre}}</b>
        </td>
    </tr>
</table>


<br>

<table border="1" style="width: 100%">
    <tr>
        <td style="width: 10%" class="text-center">
            <b>N°</b>
        </td>
        <td style="width: 50%" class="text-center">
            <b>Nombre del Producto</b>
        </td>
        <td style="width: 20%" class="text-center">
            <b>Unidad de Medida</b>
        </td>
        <td style="width: 20%" class="text-center">
            <b>Cantidad de Consumo</b>
        </td>
    </tr>


    @foreach($consumo->detalles as $key => $detalle)
        <tr>
            <td style="width: 10%" class="text-center">
                {{$key+1}}
            </td>
            <td style="width: 50%" class="text-left">
                {{$detalle->item->texto_requisicion }}
            </td>
            <td style="width: 20%" class="text-center">
                {{$detalle->item->unimed->nombre}}
            </td>
            <td style="width: 20%" class="text-center">
                {{$detalle->cantidad}}
            </td>
        </tr>
    @endforeach

    @php($maximoLineas -= count($consumo->detalles))

    <!-- llenar con filas vacias -->
    @for($i = 0; $i < $maximoLineas; $i++)
        <tr>
            <td style="width: 10%" class="text-center">
                &nbsp;
            </td>
            <td style="width: 50%" class="text-center">
                &nbsp;
            </td>
            <td style="width: 20%" class="text-center">
                &nbsp;
            </td>
            <td style="width: 20%" class="text-center">
                &nbsp;
            </td>
        </tr>
    @endfor
</table>

<br>

<table border="1" style="width: 100%;">
    <tr >
        <td style="height: 5rem; vertical-align: top">
            <!-- texto subrayado -->
            <u>OBSERVACIONES (Destino del material y/o insumo):</u>
            {{$consumo->observaciones}}

        </td>
    </tr>
</table>

<br>
<br>
<br>
<br>

<table>
    <tr>
        <td style="width: 35%; vertical-align: top; padding-right: 100px" >
            (f)
            <div style="border-bottom: 1px solid black; margin: 0 0"></div>
            <div class="text-center">
                Nombre, Firma y Sello del solicitante
            </div>
        </td>
        <td style="width: 35%; vertical-align: top; padding-left: 100px" >
            (f)
            <div style="border-bottom: 1px solid black; margin: 0 0"></div>
            <div class="text-center">
                Nombre, firma y sello del Administradora CAJ y Bufete Popular
            </div>

        </td>
    </tr>
</table>


</body>

</html>

