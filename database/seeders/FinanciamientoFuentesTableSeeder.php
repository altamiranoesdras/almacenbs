<?php

namespace Database\Seeders;

use App\Models\FinanciamientoFuente;
use Illuminate\Database\Seeder;

class FinanciamientoFuentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        FinanciamientoFuente::truncate();

        $data = [
            [
                'codigo_fuente'     => '01',
                'codigo_organismo'  => '000',  // si aplica
                'correlativo'       => '001',
                'nombre'            => 'Recursos Ordinarios',
            ],
            [
                'codigo_fuente'     => '02',
                'codigo_organismo'  => '000',
                'correlativo'       => '002',
                'nombre'            => 'Recursos Externos No Reembolsables',
            ],
            [
                'codigo_fuente'     => '03',
                'codigo_organismo'  => '000',
                'correlativo'       => '003',
                'nombre'            => 'Recursos Externos Reembolsables',
            ],
            [
                'codigo_fuente'     => '04',
                'codigo_organismo'  => '000',
                'correlativo'       => '004',
                'nombre'            => 'Recursos Propios de las Entidades',
            ],
            // Agrega otros registros conforme al manual...
        ];

        foreach ($data as $item) {
            FinanciamientoFuente::updateOrCreate(
                [
                    'codigo_fuente'    => $item['codigo_fuente'],
                    'codigo_organismo' => $item['codigo_organismo'],
                    'correlativo'      => $item['correlativo'],
                ],
                [
                    'nombre'           => $item['nombre'],
                ]
            );
        }

    }
}
