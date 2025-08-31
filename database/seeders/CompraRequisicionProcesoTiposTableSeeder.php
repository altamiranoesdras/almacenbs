<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompraRequisicionProcesoTiposTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('compra_requisicion_proceso_tipos')->delete();
        
        \DB::table('compra_requisicion_proceso_tipos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'NOG',
                'descripcion' => 'Número de Operación Guatecompras',
                'created_at' => '2025-08-31 13:47:56',
                'updated_at' => '2025-08-31 13:50:23',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'NPG',
                'descripcion' => 'Número de Publicación Guatecompras',
                'created_at' => '2025-08-31 13:48:03',
                'updated_at' => '2025-08-31 13:50:36',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}