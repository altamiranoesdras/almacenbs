<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        deshabilitaLlavesForaneas();
        Departamento::truncate();

        $departamentos = [
            // Región I, Metropolitana
            ['codigo' => '01', 'nombre' => 'Guatemala', 'region_id' => 1],

            // Región II, Norte
            ['codigo' => '15', 'nombre' => 'Baja Verapaz', 'region_id' => 2],
            ['codigo' => '16', 'nombre' => 'Alta Verapaz', 'region_id' => 2],

            // Región III, Nororiente
            ['codigo' => '19', 'nombre' => 'Zacapa', 'region_id' => 3],
            ['codigo' => '20', 'nombre' => 'Chiquimula', 'region_id' => 3],
            ['codigo' => '21', 'nombre' => 'Jalapa', 'region_id' => 3],

            // Región IV, Suroriente
            ['codigo' => '06', 'nombre' => 'Santa Rosa', 'region_id' => 4],
            ['codigo' => '22', 'nombre' => 'Jutiapa', 'region_id' => 4],

            // Región V, Central
            ['codigo' => '02', 'nombre' => 'El Progreso', 'region_id' => 5],
            ['codigo' => '03', 'nombre' => 'Sacatepéquez', 'region_id' => 5],
            ['codigo' => '04', 'nombre' => 'Chimaltenango', 'region_id' => 5],
            ['codigo' => '05', 'nombre' => 'Escuintla', 'region_id' => 5],

            // Región VI, Suroccidente
            ['codigo' => '07', 'nombre' => 'Sololá', 'region_id' => 6],
            ['codigo' => '08', 'nombre' => 'Totonicapán', 'region_id' => 6],
            ['codigo' => '09', 'nombre' => 'Quetzaltenango', 'region_id' => 6],
            ['codigo' => '10', 'nombre' => 'Suchitepéquez', 'region_id' => 6],
            ['codigo' => '11', 'nombre' => 'Retalhuleu', 'region_id' => 6],

            // Región VII, Noroccidente
            ['codigo' => '12', 'nombre' => 'San Marcos', 'region_id' => 7],
            ['codigo' => '13', 'nombre' => 'Huehuetenango', 'region_id' => 7],
            ['codigo' => '14', 'nombre' => 'Quiché', 'region_id' => 7],

            // Región VIII, Petén
            ['codigo' => '17', 'nombre' => 'Petén', 'region_id' => 8],

            // Región III (Nororiente) también incluye Izabal según el manual
            ['codigo' => '18', 'nombre' => 'Izabal', 'region_id' => 3],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}
