<?php

namespace Database\Seeders;

use App\Models\RrhhUnidadTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RrhhUnidadTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        RrhhUnidadTipo::truncate();

        $tipos = [
            ['nombre' => 'Secretaría', 'nivel' => 1],
            ['nombre' => 'Subsecretaría', 'nivel' => 2],
            ['nombre' => 'Grupo', 'nivel' => 3],
            ['nombre' => 'Dirección', 'nivel' => 4],
            ['nombre' => 'Departamento', 'nivel' => 5],
            ['nombre' => 'Área', 'nivel' => 6],
        ];

        foreach ($tipos as $tipo) {
            RrhhUnidadTipo::create($tipo);
        }
    }
}
