<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SolicitudEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('solicitud_estados')->delete();

        \DB::table('solicitud_estados')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'Solicitada',
                'created_at' => '2018-07-31 14:46:09',
                'updated_at' => '2018-07-31 14:46:09',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'Aprobada',
                'created_at' => '2018-07-31 14:46:16',
                'updated_at' => '2018-07-31 14:46:16',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'Despachada',
                'created_at' => '2018-07-31 14:46:23',
                'updated_at' => '2018-07-31 14:46:23',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'Anulada',
                'created_at' => '2018-07-31 14:46:30',
                'updated_at' => '2018-07-31 14:46:30',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'nombre' => 'Cancelada',
                'created_at' => '2018-07-31 14:46:43',
                'updated_at' => '2018-07-31 14:46:43',
                'deleted_at' => NULL,
            ),
        ));


    }
}
