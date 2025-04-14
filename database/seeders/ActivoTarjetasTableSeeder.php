<?php

namespace Database\Seeders;

use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivoTarjetasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('activo_tarjeta_detalles')->truncate();

        DB::table('activo_tarjetas')->truncate();


        ActivoTarjeta::factory()->count(50)
            ->afterCreating(function (ActivoTarjeta $tarjeta){

                ActivoTarjetaDetalle::factory()
                    ->count(rand(5,10))
                    ->create(['tarjeta_id' => $tarjeta->id]);

                $tarjeta->codigo = $this->getCodigoTarjeta();
                $tarjeta->correlativo = $this->getCorrelativoTarjeta();
                $tarjeta->save();

            })
            ->create();


    }


    public function getCodigoTarjeta($cantidadCeros = 4)
    {
        return prefijoCeros($this->getCorrelativoTarjeta(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativoTarjeta()
    {

        $correlativo = ActivoTarjeta::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

}
