<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requisición {{$compraSolicitud->codigo}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

@php
    $i=0;
    $borde=1;
    $color ="black";
    $final = 0;
@endphp

<body style="width: 100%;">


<table  style="width: 100%; margin-bottom: 2mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 33mm; text-align: left; vertical-align: middle; color: {{$color}}">Lugar y Fecha:</td>
        <td style="width: 160mm; text-align: left; vertical-align: middle;">{{ fechaLtnMesEnTexto($compraSolicitud->fecha_requiere ?? hoyDb()) }}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 4mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 46mm; text-align: left; vertical-align: middle; color: {{$color}}">Unidad Solicitante:</td>
        <td style="width: 148mm; text-align: left; vertical-align: middle;"> {{$compraSolicitud->unidad->nombre ?? ''}}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 1mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 57mm; text-align: left; vertical-align: middle; color: {{$color}}">Nombre del Solicitante:</td>
        <td style="width: 139mm; text-align: left; vertical-align: middle;">{{ $compraSolicitud->usuarioSolicita->name }}</td>
    </tr>
</table>
<table  style="width: 100%; margin-bottom: 9mm" border="{{$borde}} " >
    <tr style="height: 8mm; !important;">
        <td style="width: 17mm; text-align: left; vertical-align: middle; color: {{$color}}" >Cargo:</td>
        <td style="width: 174mm; text-align: left; vertical-align: middle;"><b>{{ $compraSolicitud->usuarioSolicita->puesto->nombre ?? "Sin puesto" }}</b></td>
    </tr>
</table>


<table  style="width: 100%; margin-bottom: 2mm;  " border="{{$borde}}; " >
    <thead class="small table-light">
    <tr class="text-sm" align="center" style="font-weight: bold">
        <td width="5%">CANTIDAD</td>
        <td width="5%">RENGLÓN</td>
        <td width="5%">CÓDIGO DE INSUMO</td>
        <td width="20%">NOMBRE</td>
        <td width="20%">DESCRIPCIÓN</td>
        <td width="5%">NOMBRE DE LA PRESENTACIÓN</td>
        <td width="5%">CANTIDAD Y UNIDAD DE MEDIDA</td>
        <td width="5%">COD. PRESENTACIÓN</td>
        <td width="5%">MONTO ESTIMADO</td>
        <td width="5%">SubTotal</td>
    </tr>
    </thead>
    <tbody>

    @foreach ($compraSolicitud->detalles as $detalle)
        @php
            $i++;
            $borde=0;
            $color ="black";
        @endphp
        <tr style="font-size: 12px; height: 6.5mm">
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->cantidad}}</td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->item->renglon->numero}}</td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->item->codigo_insumo}}</td>
            <td style="text-align: left; border: {{$borde}}px solid {{$color}}">{{$detalle->item->nombre}}</td>
            <td style="text-align: left; border: {{$borde}}px solid {{$color}}">{{$detalle->item->descripcion}}</td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->item->presentacion->nombre}}</td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->item->unimed->nombre}}</td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}">{{$detalle->item->codigo_presentacion}}</td>
            <td style="text-align: right; border: {{$borde}}px solid {{$color}}">{{number_format($detalle->precio_compra,2)}}</td>
            <td style="text-align: right; border: {{$borde}}px solid {{$color}}">{{number_format($detalle->sub_total,2)}}</td>

        </tr>
        @php
            $totalLineas = 20;
            $final = $totalLineas - $loop->iteration;
        @endphp
    @endforeach

    </tbody>

    @for ($i = 1; $i <= $final ; $i++)
        <tr style="font-size: 12px; height: 6.5mm">
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
            <td style="text-align: center; border: {{$borde}}px solid {{$color}}"></td>
        </tr>
    @endfor
</table>


</body>

</html>
