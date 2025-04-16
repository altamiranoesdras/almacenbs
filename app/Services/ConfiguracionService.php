<?php

namespace App\Services;

/**
 * Class ConfiguracionService
 * @package App
 * @version April 18, 2024, 9:29 pm CST
 */
class ConfiguracionService
{


    public function nombreNegocio()
    {
        return config('app.nombre_negocio');
    }

    public function telefonoNegocio()
    {
        return config('app.tel_negocio');
    }

    public function direccionNegocio()
    {
        return config('app.dire_negocio');
    }

    public function municipioNegocio()
    {
        return config('app.muni_negocio');
    }

    public function departamentoNegocio()
    {
        return config('app.depto_negocio');
    }

    public function paisNegocio()
    {
        return config('app.pais_negocio');
    }

    public function correoNegocio()
    {
        return config('app.mail_negocio');
    }

}