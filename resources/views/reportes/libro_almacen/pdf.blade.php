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
                <td style="border-color: black; width: 4%; text-align: center;" class="py-0" rowspan="5">
                    3/11/2022
                </td>
                <td style="border-color: black; width: 46%; text-align: center;" class="py-0" rowspan="5">
                    Serie: 86B18E09
                    <br>
                    No. 973229718
                </td>
                <td style="border-color: black; text-align: center;" class="py-0" rowspan="5">
                    3/11/2022
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0" rowspan="5">
                    DISTRIBUIDORA JALAPEÑA, SOCIEDAD ANONIMA
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0" rowspan="5">
                    330622-4
                </td>
            </tr>
            <tr>
                <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                    AP TAPA ROSCA 12/600ML ROSADA
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    4
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q30.00
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q12.00
                </td>
            </tr>
            <tr>
                <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                    AP SALVAVIDAS PET 24/300ML TR
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    16
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q26.00
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q416.00
                </td>
            </tr>
            <tr>
                <td style="border-color: black; width: 10%; text-align: center;" class="py-0">
                    AP SALVAVIDAS PET 24/300ML TR
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    16
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q26.00
                </td>
                <td style="border-color: black; width: 10%;  text-align: center;" class="py-0">
                    Q416.00
                </td>
            </tr>
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
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</html>
