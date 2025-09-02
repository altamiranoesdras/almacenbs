<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompraRequisicionTipoConcursosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        \DB::table('compra_requisicion_tipo_concursos')->delete();

        \DB::table('compra_requisicion_tipo_concursos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'Ejecución Directa',
                'descripcion' => NULL,
                'created_at' => '2025-08-20 21:06:57',
                'updated_at' => '2025-08-20 21:07:18',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'Proceso Competitivo',
                'descripcion' => NULL,
                'created_at' => '2025-08-20 21:07:10',
                'updated_at' => '2025-08-20 21:07:10',
                'deleted_at' => NULL,
            ),
        ));



    }
}
