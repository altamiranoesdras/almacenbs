<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro Almacen Mes {{ $request->get('mes') }}</title>
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
    @foreach($listadoCompras as $compra)
        <table class="table table-bordered table-sm">
            <thead>
            <tr style="text-align: center;" class="py-0">
                <th style="border-color: black;" rowspan="5">FECHA INGRESO</th>
                <th style="border-color: black;" rowspan="5">NO. FACTURA</th>
                <th style="border-color: black;" rowspan="5">FECHA FACTURA</th>
                <th style="border-color: black;" rowspan="5">NOMBRE DEL PROVEEDOR</th>
                <th style="border-color: black;" rowspan="5">NIT</th>
                <th style="border-color: black;">DESCRIPCION</th>
                <th style="border-color: black;">CANTIDAD</th>
                <th style="border-color: black;">PROCIO UNITARIO</th>
                <th style="border-color: black;">VALOR TOTAL</th>
            </tr>
            </thead>
            <tbody>
                <tr style="">
                    <td style="border-color: black; width: 4%; text-align: center;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->fecha_documento->format('d-m-Y') }}
                    </td>
                    <td style="border-color: black; width: 46%; text-align: center;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        Serie: {{ $compra->serie }}
                        <br>
                        No. {{ $compra->numero }}
                    </td>
                    <td style="border-color: black; text-align: center;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->fecha_documento->format('d-m-Y') }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->proveedor->nombre }}
                    </td>
                    <td style="border-color: black; width: 10%;  text-align: center;" class="py-0" rowspan="{{ $compra->detalles->count() + 1 }}">
                        {{ $compra->proveedor->nit }}
                    </td>
                </tr>
                @foreach($compra->detalles as $detalle)
                    <tr>
                        <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                            {{ $detalle->item->descripcion }}
                        </td>
                        <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                            {{ nf( $detalle->cantidad ) }}
                        </td>
                        <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                            {{ dvs().nf( $detalle->precio ) }}
                        </td>
                        <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                            {{ dvs().nf( $detalle->sub_total ) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot >
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <b class="pull-left">SUB TOTAL</b>
                    <td></td>
                    <td></td>
                    <td>
                        Q944.00
                    </td>

                </tr>
            </tfoot>
        </table>
        <br>
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
