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
        <table class="table table-bordered table-sm " style="border-color: black !important;">
            <thead>
                <tr style="text-align: center; background-color: #DCDCDC" class="py-0">
                    <th>No.</th>
                    <th>Descripción del articulo</th>
                    <th>Unidad de Medida</th>
                    <th>Cantidad Solicitada</th>
                    <th>Cantidad Despachada</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($solicitud->detalles as $detalle)
                    <tr style="">
                        <td style="width: 7%; text-align: center;" class="py-0">
                            {{ $loop->iteration }}
                        </td>
                        <td style=""class="py-0">
                            {{ $detalle->item->nombre }}
                        </td>
                        <td style="width: 16%; font-size: 0.8em;  text-align: center;" class="py-0">
                            {{ $detalle->item->unimed->nombre }}                            
                        </td>
                        <td style="width: 16%;  text-align: center;"class="py-0">
                            {{ $detalle->cantidad_solicitada }}
                        </td>
                        <td style="width: 16%; text-align: center;"class="py-0">
                            {{ $detalle->cantidad_despachada }}
                        </td>
                    </tr>
                    @php
                        $end = 20 - $loop->iteration;
                    @endphp
                @endforeach
                @for ($i; $i < $end ; $i++)
                    <tr style="">
                        <td style="text-align: center; ">{{ 20 - $end + $i + 1 }}</td>
                        <td style="text-align: center; " >
                             <span style="color: white">1</span>
                        </td>
                        <td style="text-align:center;">
                             
                        </td>
                        <td style="text-align:center; font-size: 0.6em; ">
                             
                        </td>
                        <td style="text-align:center;">
                             
                        </td>

                    </tr>
                @endfor
            </tbody>
        </table>
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</html>