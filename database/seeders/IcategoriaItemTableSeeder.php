<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IcategoriaItemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('icategoria_item')->delete();

        \DB::table('icategoria_item')->insert(array (
            0 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 18,
            ),
            1 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 19,
            ),
            2 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 21,
            ),
            3 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 24,
            ),
            4 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 25,
            ),
            5 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 30,
            ),
            6 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 51,
            ),
            7 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 65,
            ),
            8 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 80,
            ),
            9 =>
            array (
                'icategoria_id' => 2,
                'item_id' => 81,
            ),
            10 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 12,
            ),
            11 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 13,
            ),
            12 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 14,
            ),
            13 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 15,
            ),
            14 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 16,
            ),
            15 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 17,
            ),
            16 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 20,
            ),
            17 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 23,
            ),
            18 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 66,
            ),
            19 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 67,
            ),
            20 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 68,
            ),
            21 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 69,
            ),
            22 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 70,
            ),
            23 =>
            array (
                'icategoria_id' => 4,
                'item_id' => 71,
            ),
        ));


    }
}
