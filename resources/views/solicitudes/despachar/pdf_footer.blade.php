<style>
    footer {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
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
            <td class="left" colspan="4" style="height: 50px; width: 100%">
                {{$solicitud->observaciones ?? ''}}
            </td>
        </tr>
    </table>

    <table style="margin-top: 100px; width: 100%;border-collapse: collapse;">
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

    <table style="margin-top: 40px; width: 100%; border-collapse: collapse;">
        <tr style="height: 40px;">
            <td style="border: none; width: 100%; text-align: left;">
                RECIBIDO POR: _________________________________________________________________________________________________________________________________
            </td>
        </tr>
        <tr style="height: 40px;">
            <td style="border: none; width: 100%;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="padding: 20px">
                        <td style="border: none; text-align: left; width: 50%; padding: 30px 0">
                            FECHA RECIBIDO: ___________________________________________
                        </td>
                        <td style="border: none; text-align: right; width: 50%;">
                            FIRMA: ___________________________________________
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 40px; width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width: 15%; border: none; text-align: center;"></td>
            <td style="width: 70%; border: none; text-align: center;">
                Autorizado según Resolución de la Contraloría General de Cuentas No. F.O. xxxxxxx Gestión: xxxxx de fecha xx-xx-xxxx, correlativo xx-xxxx de
                fecha xx-xx-xxxx, Envío fiscal xxxx de fecha xx-xx-xxxx, Autorizado del 0001 al 2,000 Sin Serie, Libro x-xxxx Folio xx SECRETARÍA DE
                BIENESTAR SOCIAL DE LA PRESIDENCIA DE LA REPÚBLICA NIT 3377881
            </td>
            <td style="width: 15%; border: none; text-align: center;"></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100%; border: none; text-align: center; color: #cd0303; font-weight: bold"><h3>- Original: Almacén -</h3></td>
        </tr>
    </table>
</footer>
<!-- Justificación -->

