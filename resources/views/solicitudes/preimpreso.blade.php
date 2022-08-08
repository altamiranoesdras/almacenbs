<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $solicitud->id }}</title>
</head>
@php
    $escala = 1.2;
    $ancho = 22 * $escala;
    $padding_top = 0.184;
    $padding_bottom = 0.139;
    $i=0;
@endphp
<body style="width: {{ $ancho }}cm;">
    <div style=" width: 100%; padding-left: 0.2cm; height: {{ 3.2 * $escala }}cm; ">
    </div>
    <div>
        <span style="font-size: 1.4em">
            <span style="margin-left: 6.5cm; font-weight: 600">{{ $solicitud->unidad->nombre }}</span><br>
            <div style="margin-top: 0.35cm"></div>
            <span style="margin-left: 2cm; margin-top: 0.4cm; font-weight: 600"> {{ $solicitud->created_at->format('d/m/Y') }} </span>
            <span style="margin-left: 11.3cm; margin-top: 0.4cm; font-weight: 600">  1  </span>
            <span style="margin-left: 3.5cm; margin-top: 0.4cm; font-weight: 600">  {{ $solicitud->detalles->count() }}  </span>
        </span>
    </div>
    <div style="margin-top: 1.15cm; margin-left: 1.3cm;">
        <table style="width: 100%">
            @foreach ($solicitud->detalles as $detalle)
                <tr style="">
                    <td style="padding-top: {{ $padding_top }}cm; padding-bottom: {{ $padding_bottom }}cm; width:35.08%" >
                        {{ $detalle->item->nombre }}
                    </td>
                    <td style="width:9.95%; text-align:center;">
                        {{ $detalle->cantidad_solicitada }}
                    </td>
                    <td style="width:11.78%; text-align:center; font-size: 0.8em; ">
                        {{ $detalle->item->unimed->nombre }}
                    </td>
                    <td style="width:12.3%; text-align:center;">
                        {{ $detalle->cantidad_despachada }}
                    </td>
                    <td style="width:25.65%; padding-left: 0.2cm;">
                        {{ $detalle->obsercaciones }}
                    </td>
                </tr>
                @php
                    $end = 20 - $loop->iteration;
                @endphp
            @endforeach
            @for ($i; $i < $end ; $i++)
                <tr style="">
                    <td style="padding-top: {{ $padding_top }}cm; padding-bottom: {{ $padding_bottom }}cm; width:35.08%" >
                         <span style="color: white">1</span>
                    </td>
                    <td style="width:9.95%; text-align:center;">
                         
                    </td>
                    <td style="width:11.78%; text-align:center; font-size: 0.6em; ">
                         
                    </td>
                    <td style="width:12.3%; text-align:center;">
                         
                    </td>
                    <td style="width:25.65%; padding-left: 0.2cm;">
                         
                    </td>
                </tr>
            @endfor
        </table>

        <br>
        <br>
    </div>
    <div style="font-size: 1.2em; font-weight: 600; margin-top: 0.2cm; margin-left: 0.7cm; text-align: center; width: 24%" >
        {{ $solicitud->usuarioSolicita->name }}
    </div>

    <div style="font-size: 1.2em; font-weight: 600; margin-top: 3.3cm; margin-left: 0.7cm; text-align: center; width: 24%" >
        {{-- Jefe --}}
    </div>
</body>
</html>