<?php

namespace Database\Seeders;

use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudDetalle;
use Illuminate\Database\Seeder;

class CompraSolicitudsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        CompraSolicitudDetalle::truncate();
        CompraSolicitud::truncate();

        CompraSolicitud::factory()->count(10)
            ->create()
            ->each(function ($compraSolicitud) {
                CompraSolicitudDetalle::factory()->count(5)->create([
                    'solicitud_id' => $compraSolicitud->id,
                ]);
            });
    }
}
