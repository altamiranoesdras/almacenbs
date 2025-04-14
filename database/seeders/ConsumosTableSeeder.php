<?php

namespace Database\Seeders;

use App\Models\Consumo;
use App\Models\ConsumoDetalle;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Consumo::truncate();
        ConsumoDetalle::truncate();

        Consumo::factory()
            ->count(10)
            ->sequence(function ($sequence){

                $correlativo = $sequence->index;

                return [
                    'codigo' => $this->getCodigo($correlativo),
                    'correlativo' => $correlativo
                ];
            })
            ->afterCreating(function (Consumo $consumo){

                ConsumoDetalle::factory()->count(rand(5,8))->create([
                    'consumo_id' => $consumo->id
                ]);

            })
            ->create();

    }

    public function getCodigo($correlativo,$cantidadCeros = 3)
    {
        return "CMO-".prefijoCeros($correlativo,$cantidadCeros)."-".Carbon::now()->year;
    }

}
