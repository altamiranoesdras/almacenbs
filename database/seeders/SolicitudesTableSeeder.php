<?php

namespace Database\Seeders;

use App\Models\Bitacora;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Models\StockTransaccion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        Solicitud::truncate();
        SolicitudDetalle::truncate();
        Bitacora::where('model_type', Solicitud::class)->forceDelete();
        StockTransaccion::where('model_type', SolicitudDetalle::class)->forceDelete();


        Solicitud::factory()
            ->count(20)
            ->state(new Sequence(
                [
                    'estado_id' => SolicitudEstado::SOLICITADA,
                ],
                [
                    'estado_id' => SolicitudEstado::AUTORIZADA,
                ],
                [
                    'estado_id' => SolicitudEstado::DESPACHADA,
                ]
                ,[
                    'estado_id' => SolicitudEstado::ANULADA,
                ]
            ))
            ->state(new Sequence(
                function ($sequence) {
                    $index = $sequence->index;
                    return [
                        'codigo' => "REQ-" . prefijoCeros($index + 1, 4) . "-" . Carbon::now()->year,
                        'correlativo' => $index + 1,
                    ];
                }
            ))
            ->has(
                SolicitudDetalle::factory()
                    ->count(rand(5,10))
                    ->state(new Sequence(
                        ['cantidad_solicitada' => 10,'cantidad_autorizada' => 10, 'cantidad_despachada' => 10, 'precio' => 100],
                        ['cantidad_solicitada' => 20,'cantidad_autorizada' => 20, 'cantidad_despachada' => 20, 'precio' => 150],
                    )),
                'detalles'
            )
            ->create();



    }




}
