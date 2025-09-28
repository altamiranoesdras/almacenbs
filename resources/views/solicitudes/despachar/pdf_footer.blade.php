<style>
    footer {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table tr th, table tr td {
        font-size: 11px;
    }
    td, th {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: middle;
    }
    .no-border td {
        border: none;
        padding: 2px;
    }
</style>
<footer>
    <table style="width: 100%">
        <tr>
            <td class="left" colspan="4" style="border: none">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td class="left" colspan="4" style="height: 55px; width: 100%">
                {{$solicitud->observaciones ?? ''}}
            </td>
        </tr>
    </table>

    <table style="margin-top: 80px; width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                SOLICITADO POR
            </td>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                APROBADO POR
            </td>
            <td style="width: 33%; border: none; text-align: center;">
                _______________________________<br><br>
                DESPACHADO POR
            </td>
        </tr>
    </table>

    <table style="margin-top: 30px; width: 100%; border-collapse: collapse;">
        <tr style="height: 25px;">
            <td style="border: none; width: 100%; text-align: left;">
                RECIBIDO POR: _____________________________________________________________________________________________________________________________
            </td>
        </tr>
        <tr style="height: 15px;">
            <td style="border: none; width: 100%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="padding: 5px">
                        <td style="border: none; text-align: left; width: 50%; padding: 15px 0; font-size: 11px">
                            FECHA RECIBIDO: ___________________________________________
                        </td>
                        <td style="border: none; text-align: right; width: 50%; font-size: 11px">
                            FIRMA: ___________________________________________
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 5px; width: 100%;border-collapse: collapse; font-size: 11px">
        <tr>
            <td style="width: 15%; border: none; text-align: center;"></td>
            <td style="width: 70%; border: none; text-align: center;">
                Autorizado según Resolución de la Contraloría General de Cuentas No. F.O. {{ $envioFiscal->numero_cuenta }}  Gestión: {{ $envioFiscal->numero_gestion }} de
                fecha {{ fechaLtn($envioFiscal->fecha_gestion) }}, correlativo {{ $envioFiscal->correlativo }} de
                fecha {{ fechaLtn($envioFiscal->fecha)  }}, Envío fiscal {{ $envioFiscal->folio }} de fecha {{fechaLtn($envioFiscal->fecha)}},
                Autorizado del {{ nfp($envioFiscal->correlativo_del, 0) }} al {{ nfp($envioFiscal->correlativo_al, 0) }} Serie {{ $envioFiscal->serie }}, Libro
                {{ $envioFiscal->libro }} Folio {{ $envioFiscal->folio }} SECRETARÍA DE
                BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA NIT 3377881
            </td>
            <td style="width: 15%; border: none; text-align: center;"></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100%; border: none; text-align: center; color: #cd0303; font-weight: bold">
                <h3>- Original: Contabilidad -</h3></td>
        </tr>
    </table>
</footer>
<!-- Justificación -->

