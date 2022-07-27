<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('clientes')->delete();

        \DB::table('clientes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nit' => 'CF',
                'nombres' => 'Consumidor',
                'apellidos' => 'Final',
                'telefono' => NULL,
                'email' => NULL,
                'genero' => 'M',
                'fecha_nacimiento' => NULL,
                'direccion' => NULL,
                'created_at' => '2017-04-17 11:05:46',
                'updated_at' => '2017-06-01 10:18:42',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nit' => '',
                'nombres' => 'Negocio',
                'apellidos' => 'Mismo (Traslados o Consumos)',
                'telefono' => NULL,
                'email' => NULL,
                'genero' => 'M',
                'fecha_nacimiento' => NULL,
                'direccion' => NULL,
                'created_at' => '2017-04-17 11:05:46',
                'updated_at' => '2017-06-01 10:18:42',
                'deleted_at' => NULL,
            ),
        ));


        if (app()->environment()=='local'){
            factory(\App\Models\Cliente::class,20)->create();
        }


    }
}
