<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MagnitudesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('magnitudes')->delete();

        \DB::table('magnitudes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'Unidad',
                'created_at' => '2017-07-28 09:14:52',
                'updated_at' => '2017-07-28 10:00:20',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'Volumen',
                'created_at' => '2017-07-28 09:15:03',
                'updated_at' => '2017-07-28 10:00:32',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'Longitud',
                'created_at' => '2017-07-28 09:16:07',
                'updated_at' => '2017-07-28 09:16:07',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'Peso',
                'created_at' => '2017-07-28 10:00:46',
                'updated_at' => '2017-07-28 10:00:46',
                'deleted_at' => NULL,
            ),
        ));


    }
}
