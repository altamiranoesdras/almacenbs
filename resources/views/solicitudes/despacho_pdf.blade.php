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
    <div style="padding-top: 180px">
        <table style="width: 100%" border="1">
            <tr>
                <td colspan="2">DEPARTAMENTO SOLICITANTE: {{ $solicitud->unidad->nombre }}</td>
            </tr>
            <tr>
                <td >NOMBRE SOLICITANTE: {{ $solicitud->usuarioSolicita->name }}</td>
                <td >FECHA ENTREGA: {{ $solicitud->updated_at->format('d/m/Y') }}</td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered table-sm" >
            <thead>
                <tr style="text-align: center; background-color: #DCDCDC;  " class="py-0">
                    <th style="border-color: black;" >No.</th>
                    <th style="border-color: black;">Descripción del articulo</th>
                    <th style="border-color: black;">Unidad de Medida</th>
                    <th style="border-color: black;">Cantidad Solicitada</th>
                    <th style="border-color: black;">Cantidad Despachada</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($solicitud->detalles as $detalle)
                    <tr style="">
                        <td style="border-color: black; width: 7%; text-align: center;" class="py-0">
                            {{ $loop->iteration }}
                        </td>
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
                @for ($i =  $final; $i <= $totalLineas ; $i++)
                    <tr style="">
                        <td style="border-color: black; text-align: center; " class="py-0">{{  $i  }}</td>
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
    </div>
    <div style="width: 100%; border: 1px; border-style: solid; padding: 5px;">
        OBSERVACIONES: {{ $solicitud->observaciones }}
    </div>

    <div style="margin-top: 15px">
        <table class="w-100 table table-bordered ">
            <tr>
                <td class="py-0">
                    RECIBÍ CONFORME: {{ $solicitud->usuarioSolicita->name }}
                </td>
                <td class="py-0">
                    DESPACHADO POR: {{ $solicitud->usuarioDespacha->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="py-0 px-0 my-0">
                    <table style="width: 100%" class="table-borderless">
                        <tr class="py-0 px-0 my-0">
                            <td class="pt-0" style="padding-bottom: 80px;">FIRMA:</td>
                            <td class="pt-0">SELLO:</td>
                        </tr>
                    </table>
                    <span style="margin-left: 10px">DPI: {{ $solicitud->usuarioSolicita->dpi }}</span>
                </td>
                <td>
                    <table style="width: 100%" class="table-borderless">
                        <tr class="py-0 px-0 my-0">
                            <td class="pt-0" style="padding-bottom: 80px;">FIRMA:</td>
                            <td class="pt-0">SELLO:</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="py-0">
                    <span style="margin-left: 10px">Vo.Bo.: JEFE INMEDIATO DE QUIEN RECIBE</span>
                    <table style="width: 100%" class="table-borderless">
                        <tr class="py-0 px-0 my-0">
                            <td class="pt-0" style="padding-bottom: 80px;">FIRMA:</td>
                            <td class="pt-0">SELLO:</td>
                        </tr>
                    </table>
                    <span style="margin-left: 10px">DPI: </span>
                </td>
                <td class="py-0">
                    <span style="margin-left: 10px">Vo.Bo.: JEFE INMEDIATO DE QUIEN RECIBE</span>
                    Vo.Bo.: JEFE INMEDIATO DE QUIEN ENTREGA
                    <table style="width: 100%" class="table-borderless">
                        <tr class="py-0 px-0 my-0">
                            <td class="pt-0" style="padding-bottom: 80px;">FIRMA:</td>
                            <td class="pt-0">SELLO:</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>
