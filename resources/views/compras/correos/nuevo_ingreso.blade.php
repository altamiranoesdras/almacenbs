<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo ingreso registrado</title>
</head>
<body style="margin:0; padding:0; background:#f0f4f8; font-family: Arial, sans-serif;">

<!-- Encabezado institucional -->
<div style="background:#1b3a57; color:white; text-align:center; padding:20px 0; font-size:20px; font-weight:bold;">
    Secretaría de Bienestar Social – SIGUA
</div>

<!-- Contenedor principal -->
<div style="max-width: 800px; background:white; margin:30px auto; padding:30px; border-radius:8px;
                box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <h2 style="margin-top:0; color:#1b3a57;">¡Hola!</h2>

    <p style="font-size:15px; color:#333;">
        Se ha registrado un nuevo ingreso para la unidad.
    </p>

    <!-- TÍTULO DE SECCIÓN -->
    <h3 style="color:#1b3a57; border-bottom:2px solid #1b3a57; padding-bottom:5px;">
        Detalles de la compra
    </h3>

    <!-- Tabla de datos generales -->
    <table width="100%" cellpadding="6" cellspacing="0">
        <tr>
            <td width="33%" style="vertical-align: top;">
                <strong>Tipo:</strong><br>
                {{ $compra->tipo->nombre ?? '' }}
            </td>

            <td width="33%" style="vertical-align: top;">
                <strong>Proveedor:</strong><br>
                {{ $compra->proveedor->nombre ?? '' }}
            </td>

            <td width="33%" style="vertical-align: top;">
                <strong>Estado:</strong><br>
                <span style="background:#eef3f8; padding:3px 6px; border-radius:4px;">
                        {{ $compra->estado->nombre ?? 'Sin estado' }}
                    </span>
            </td>
        </tr>

        @if(!empty($compra->serie) && !empty($compra->numero))
            <tr>
                <td colspan="3" style="padding-top:10px;">
                    <strong>S/N:</strong> {{ $compra->serie }}-{{ $compra->numero }}
                </td>
            </tr>
        @endif

        @if(!empty($compra->recibo_de_caja))
            <tr>
                <td colspan="3">
                    <strong>Recibo de Caja:</strong> {{ $compra->recibo_de_caja }}
                </td>
            </tr>
        @endif

        <tr>
            <td>
                <strong>Folio 1H:</strong><br>
                {{ $compra->compra1h->folio ?? 'Sin 1H' }}
            </td>

            <td>
                <strong>Fecha Recepción:</strong><br>
                {{ fechaLtn($compra->fecha_ingreso) }}
            </td>

            <td>
                <strong>Fecha Documento:</strong><br>
                {{ fechaLtn($compra->fecha_documento) }}
            </td>
        </tr>

        <tr>
            <td colspan="3" style="padding-top:10px;">
                <strong>Observaciones:</strong><br>
                {{ $compra->observaciones }}
            </td>
        </tr>
    </table>

    <!-- DETALLES DE PRODUCTOS -->
    <h3 style="margin-top:30px; color:#1b3a57; border-bottom:2px solid #1b3a57; padding-bottom:5px;">
        Detalles de los productos
    </h3>

    <!-- Tabla de productos -->
    <table width="100%" cellpadding="6" cellspacing="0" border="1"
           style="border-collapse: collapse; border-color:#d0d7df; font-size:14px;">
        <thead style="background:#eef3f8;">
        <tr>
            <th align="left">Insumo</th>
            <th align="left">Categoría</th>
            <th align="right">Precio</th>
            <th align="right">Cantidad</th>
            <th align="left">Unidad Solicita</th>
            <th align="left">Fecha Vence</th>
            <th align="right">Subtotal</th>
        </tr>
        </thead>

        <tbody>
        @foreach($compra->detalles as $det)
            <tr>
                <td>
                    @if($det->item->deleted_at)
                        <del>{{ $det->item->text }}</del>
                    @else
                        {{ $det->item->text }}
                    @endif
                </td>

                <td>{{ $det->item->categoria->nombre ?? 'Sin categoría' }}</td>

                <td align="right">{{ dvs().nfp($det->precio) }}</td>

                <td align="right">{{ nf($det->cantidad) }}</td>

                <td>{{ $det->unidadSolicitante->nombre ?? 'Sin unidad' }}</td>

                <td>{{ fechaLtn($det->fecha_vence) }}</td>

                <td align="right">{{ dvs().nf($det->cantidad * $det->precio) }}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot style="background:#fafafa;">
        <tr>
            <td colspan="6" align="right"><strong>Sub Total</strong></td>
            <td align="right">{{ dvs().nfp($compra->sub_total, 2) }}</td>
        </tr>

        <tr>
            <td colspan="6" align="right"><strong>Descuento</strong></td>
            <td align="right" style="color: green;">{{ dvs().nf($compra->descuento) }}</td>
        </tr>

        <tr>
            <td colspan="6" align="right"><strong>Total</strong></td>
            <td align="right" style="font-weight:bold;">{{ dvs().nf($compra->total) }}</td>
        </tr>
        </tfoot>
    </table>

    <!-- BOTÓN -->
    <p style="margin-top:30px; text-align:center;">
        <a href="{{ route('compras.show', $compra->id) }}"
           style="background:#1b3a57; color:white; padding:12px 22px; text-decoration:none;
                      border-radius:6px; font-size:15px; display:inline-block;">
            Ver compra en SIGUA
        </a>
    </p>

    <p style="color:#555; font-size:13px; margin-top:30px;">
        Gracias por usar nuestra aplicación.
    </p>

</div> <!-- FIN CONTENEDOR -->

</body>
</html>
