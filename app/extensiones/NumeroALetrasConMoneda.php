<?php


namespace App\extensiones;


use stdClass;

class NumeroALetrasConMoneda
{

    public static function Unidades($num){

        switch($num)
        {
            case 1: return 'UN';
            case 2: return 'DOS';
            case 3: return 'TRES';
            case 4: return 'CUATRO';
            case 5: return 'CINCO';
            case 6: return 'SEIS';
            case 7: return 'SIETE';
            case 8: return 'OCHO';
            case 9: return 'NUEVE';
        }

        return '';
    }//Unidades()

    public static function Decenas($num){

        $decena = floor($num/10);
        $unidad = $num - ($decena * 10);

        switch($decena)
        {
            case 1:
                switch($unidad)
                {
                    case 0: return 'DIEZ';
                    case 1: return 'ONCE';
                    case 2: return 'DOCE';
                    case 3: return 'TRECE';
                    case 4: return 'CATORCE';
                    case 5: return 'QUINCE';
                    default: return 'DIECI' . self::Unidades($unidad);
                }
            case 2:
                switch($unidad)
                {
                    case 0: return 'VEINTE';
                    default: return 'VEINTI' . self::Unidades($unidad);
                }
            case 3: return self::DecenasY('TREINTA', $unidad);
            case 4: return self::DecenasY('CUARENTA', $unidad);
            case 5: return self::DecenasY('CINCUENTA', $unidad);
            case 6: return self::DecenasY('SESENTA', $unidad);
            case 7: return self::DecenasY('SETENTA', $unidad);
            case 8: return self::DecenasY('OCHENTA', $unidad);
            case 9: return self::DecenasY('NOVENTA', $unidad);
            case 0: return self::Unidades($unidad);
        }
    }//Decenas()

    public static function DecenasY($strSin, $numUnidades) {
        if ($numUnidades > 0)
            return $strSin . ' Y ' . self::Unidades($numUnidades);

        return $strSin;
    }//DecenasY()

    public static function Centenas($num) {
        $centenas = floor($num / 100);
        $decenas = $num - ($centenas * 100);

        switch($centenas)
        {
            case 1:
                if ($decenas > 0)
                    return 'CIENTO ' . self::Decenas($decenas);
                return 'CIEN';
            case 2: return 'DOSCIENTOS ' . self::Decenas($decenas);
            case 3: return 'TRESCIENTOS ' . self::Decenas($decenas);
            case 4: return 'CUATROCIENTOS ' . self::Decenas($decenas);
            case 5: return 'QUINIENTOS ' . self::Decenas($decenas);
            case 6: return 'SEISCIENTOS ' . self::Decenas($decenas);
            case 7: return 'SETECIENTOS ' . self::Decenas($decenas);
            case 8: return 'OCHOCIENTOS ' . self::Decenas($decenas);
            case 9: return 'NOVECIENTOS ' . self::Decenas($decenas);
        }

        return self::Decenas($decenas);
    }//Centenas()

    public static function Seccion($num, $divisor, $strSingular, $strPlural) {
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $letras = '';

        if ($cientos > 0)
            if ($cientos > 1)
                $letras = self::Centenas($cientos) . ' ' . $strPlural;
            else
                $letras = $strSingular;

        if ($resto > 0)
            $letras .= '';

        return $letras;
    }//Seccion()

    public static function Miles($num) {
        $divisor = 1000;
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $strMiles = self::Seccion($num, $divisor, 'UN MIL', 'MIL');
        $strCentenas = self::Centenas($resto);

        if($strMiles == '')
            return $strCentenas;

        return $strMiles . ' ' . $strCentenas;
    }//Miles()

    public static function Millones($num) {
        $divisor = 1000000;
        $cientos = floor($num / $divisor);
        $resto = $num - ($cientos * $divisor);

        $strMillones = self::Seccion($num, $divisor, 'UN MILLON DE', 'MILLONES DE');
        $strMiles = self::Miles($resto);

        if($strMillones == '')
            return $strMiles;

        return $strMillones . ' ' . $strMiles;
    }//Millones()

    public static function Convertir($num, $currency) {
    $currency = $currency ?? 'Q';

    $data = new stdClass();
    $data->numero = $num;
    $data->enteros = floor($num);
    $data->centavos = (((round($num * 100)) - (floor($num) * 100)));
    $data->letrasCentavos = '';
    $data->letrasMonedaPlural = $currency->plural ?? 'QUETZALES';//'PESOS', 'Dólares', 'Bolívares', 'etcs'
    $data->letrasMonedaSingular = $currency->singular ?? 'QUETZAL'; //'PESO', 'Dólar', 'Bolivar', 'etc'
    $data->letrasMonedaCentavoPlural = $currency->centPlural ?? 'CENTAVOS';
    $data->letrasMonedaCentavoSingular = $currency->centSingular ?? 'CENTAVOS';

        if ($data->centavos > 0) {
            $data->letrasCentavos = 'CON ' . (function ($data) {
                    if ($data->centavos == 1)
                        return self::Millones($data->centavos) . ' ' . $data->letrasMonedaCentavoSingular;
                    else
                        return self::Millones($data->centavos) . ' ' . $data->letrasMonedaCentavoPlural;
                })();
        };

        if($data->enteros == 0)
            return 'CERO ' . $data->letrasMonedaPlural . ' ' . $data->letrasCentavos;
        if ($data->enteros == 1)
            return self::Millones($data->enteros) . ' ' . $data->letrasMonedaSingular . ' ' . $data->letrasCentavos;
        else
            return self::Millones($data->enteros) . ' ' . $data->letrasMonedaPlural . ' ' . $data->letrasCentavos;
    }


}
