
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

    #datosGenerales tr td {
        height: 5px;
        width: 75%;
        border: none;
        padding: 8px 15px;
    }

    #datosGenerales tr {
        padding: 10px;
    }
</style>
<footer>

    <!-- Justificación -->
    <table style="margin-top: 15px; width: 100%">
        <tr>
            <td class="left" colspan="4" style="border: none">OBSERVACIONES:</td>
        </tr>
        <tr>
            <td class="left" colspan="4" style="height: 50px; width: 100%">
                {{$compra->compra1h->observaciones ?? ''}}
            </td>
        </tr>
    </table>

    <table style="margin-top: 100px; width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                OPERADO POR
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                JEFE DE ALMACEN
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                DIRECTOR ADMINISTRATIVO
            </td>
            <td style="width: 25%; border: none; text-align: center;">
                _______________________________<br><br>
                JEFE DE INVENTARIOS
            </td>
        </tr>
    </table>

    <table style="margin-top: 40px; width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width: 15%; border: none; text-align: center;"></td>
            <td style="width: 70%; border: none; text-align: center;">
                Autorizado según Resolución de la Contraloría General de Cuentas No. F.O. xxxxxxx Gestión: xxxxx de
                fecha xx-xx-xxxx, correlativo xx-xxxx de
                fecha xx-xx-xxxx, Envío fiscal xxxx de fecha xx-xx-xxxx, Autorizado del 0001 al 2,000 Sin Serie, Libro
                x-xxxx Folio xx SECRETARÍA DE
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

