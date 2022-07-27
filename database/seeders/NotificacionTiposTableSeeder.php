<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificacionTiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('notificacion_tipos')->delete();

        \DB::table('notificacion_tipos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'Solicitud',
                'created_at' => '2018-08-01 14:23:13',
                'updated_at' => '2018-08-01 14:23:49',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'Orden',
                'created_at' => '2018-08-01 14:25:27',
                'updated_at' => '2018-08-01 14:25:28',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'Delivery',
                'created_at' => '2018-08-01 14:25:44',
                'updated_at' => '2018-08-01 14:25:45',
                'deleted_at' => NULL,
            ),
        ));


    }
}
