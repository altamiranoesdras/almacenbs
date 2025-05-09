<?php

namespace Database\Seeders;

use App\Models\CompraSolicitud;
use App\Models\CompraSolicitudDetalle;
use Carbon\Carbon;
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
            ->sequence(function ($sequence) {
                $correlativo = $sequence->index + 1;
                $codigo =  str_pad($correlativo, 4, '0', STR_PAD_LEFT) . '-' . Carbon::now()->year;
                return [
                    'correlativo' => $correlativo,
                    'codigo' => $codigo,
                ];
            })
            ->create()
            ->each(function ($compraSolicitud) {
                CompraSolicitudDetalle::factory()->count(5)->create([
                    'solicitud_id' => $compraSolicitud->id,
                ]);
            });
    }
}
