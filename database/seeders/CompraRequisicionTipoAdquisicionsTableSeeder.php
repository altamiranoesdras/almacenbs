<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompraRequisicionTipoAdquisicion;

class CompraRequisicionTipoAdquisicionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        deshabilitaLlavesForaneas();
        CompraRequisicionTipoAdquisicion::truncate();

        $tipos = [
            1  => 'Cotización',
            2  => 'Licitación',
            3  => 'Modalidades específicas',
            4  => 'Compra Directa',
            5  => 'Adquisiciones con Proveedor Único (Manifestación de interés)',
            6  => 'Arrendamientos (Bienes muebles o equipo)',
            7  => 'Arrendamiento o adquisición de bienes inmuebles',
            8  => 'Casos de Excepción contemplados en la LEY',
            9  => 'Contrato Abierto',
            10 => 'Subasta Electrónica Inversa',
            11 => 'Adquisiciones de Bienes y Suministros Importados',
            12 => 'Adquisiciones al amparo de Convenios/Tratados Internacionales o donaciones',
            13 => 'Adquisiciones que superen la compra directa (Art. 54 LEY, 25 Reglamento)',
            14 => 'Negociaciones entre entidades del sector público (Art. 2 LEY)',
            15 => 'Adquisición Directa por Ausencia de Ofertas',
            16 => 'Subasta Pública',
            17 => 'Otros tipos de concursos por reformas a la LEY',
            18 => 'Compra de Baja Cuantía',
            19 => 'Arrendamiento o adquisición de bienes inmuebles (Reiterado)',
            20 => 'Negociaciones entre entidades del sector público (Reiterado)',
            21 => 'Adquisiciones al amparo de Convenios/Tratados Internacionales o donaciones (Reiterado)',
            22 => 'Casos de excepción contemplados en la LEY (Reiterado)',
            23 => 'Adquisiciones que superen compra directa (Reiterado)',
            24 => 'Otros tipos de adquisición directa por leyes o resoluciones judiciales',
        ];

        foreach ($tipos as $id => $nombre) {
            CompraRequisicionTipoAdquisicion::factory()->create([
                'id'     => $id,
                'nombre' => $nombre,
            ]);
        }

        habilitaLlavesForaneas();
    }
}
