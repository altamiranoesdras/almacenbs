<?php
namespace Database\Seeders;

use App\Models\SolicitudDetalle;
use App\Models\Solicitud;
use Illuminate\Database\Seeder;

class SolicitudStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Solicitude::class,50)->create()
            ->each(function (Solicitude $solicitud){

                $correlativo = \App\Facades\Correlativo::siguiente('solicitudes');

                $solicitud->correlativo= $correlativo->max;
                $solicitud->save();
                $correlativo->save();

                factory(SolicitudDetalle::class,random_int(5,15))->create(['solicitude_id' => $solicitud->id]);
            });
    }
}
