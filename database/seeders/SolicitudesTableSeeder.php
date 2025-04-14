<?php

namespace Database\Seeders;

use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\User;
use Carbon\Carbon;
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



        DB::table('solicitudes')->truncate();
        DB::table('solicitud_detalles')->truncate();


        Solicitud::factory()
            ->count(20)
            ->afterCreating(function (Solicitud $solicitud){

                SolicitudDetalle::factory()->count(rand(5,10))->create([
                    'solicitud_id' => $solicitud->id
                ]);

                $solicitud->codigo = $this->getCodigo();
                $solicitud->correlativo = $this->getCorrelativo();
                $solicitud->save();


                $fechaSolicita = Carbon::now()->subDays(rand(0,3));
                $fechaAutoriza = $fechaSolicita->copy()->addHours(rand(2,5));
                $fechaAprueba = $fechaAutoriza->copy()->addHours(rand(2,5));
                $fechaDespacha = $fechaAprueba->copy()->addHours(rand(5,10));

                $solicitud->fecha_solicita = $fechaSolicita;

                if ($solicitud->estaAutoizada()){
                    $solicitud->fecha_autoriza = $fechaAutoriza;
                    $solicitud->usuario_autoriza = User::all()->random()->id;
                }

                if ($solicitud->estaAprobada()){

                    $solicitud->fecha_autoriza = $fechaAutoriza;
                    $solicitud->usuario_autoriza = User::all()->random()->id;

                    $solicitud->fecha_aprueba = $fechaAprueba;
                    $solicitud->usuario_aprueba = User::all()->random()->id;
                }

                if ($solicitud->estaDespachada()){

                    $solicitud->fecha_autoriza = $fechaAutoriza;
                    $solicitud->usuario_autoriza = User::all()->random()->id;

                    $solicitud->fecha_aprueba = $fechaAprueba;
                    $solicitud->usuario_aprueba = User::all()->random()->id;


                    $solicitud->fecha_despacha = $fechaDespacha;
                    $solicitud->usuario_despacha = User::all()->random()->id;


                    $solicitud->egreso();
                }

                if ($solicitud->estaAnulada()){
                    $solicitud->fecha_autoriza = $fechaAutoriza;
                    $solicitud->fecha_aprueba = $fechaAprueba;
                    $solicitud->fecha_despacha = $fechaDespacha;
                    $solicitud->anular();
                }

                $solicitud->save();
            })
            ->create();



    }




    public function getCodigo($cantidadCeros = 3)
    {
        return "REQ-".prefijoCeros($this->getCorrelativo(),$cantidadCeros)."-".Carbon::now()->year;
    }

    public function getCorrelativo()
    {

        $correlativo = Solicitud::withTrashed()->whereRaw('year(created_at) ='.Carbon::now()->year)->max('correlativo');


        if ($correlativo)
            return $correlativo+1;

        return 1;
    }

}
