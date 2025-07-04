<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('user_configurations')->truncate();

        \DB::table('user_configurations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'key' => 'app.mode-layout',
                'value' => 'light-layout',
                'description' => 'Cambio de modo de la aplicación dark o light',
                'created_at' => '2025-07-02 23:19:47',
                'updated_at' => '2025-07-02 23:19:47',
                'deleted_at' => NULL,
            ),
        ));

    }
}
