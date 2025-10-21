<?php

namespace Database\Factories;

use App\Models\EnvioFiscal;
use App\Models\RrhhUnidad;
use App\Models\Solicitud;
use App\Models\SolicitudEstado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitud::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $userRandom = User::all()->random();

        $estados = [
            SolicitudEstado::SOLICITADA,
            SolicitudEstado::AUTORIZADA,
            SolicitudEstado::APROBADA,
            SolicitudEstado::DESPACHADA,
        ];


        return [
            'codigo' => $this->faker->word,
            'correlativo' => $this->faker->randomDigitNotNull,
            'justificacion' => $this->faker->text,
            'unidad_id' => RrhhUnidad::all()->random()->id,
            'observaciones' => $this->faker->paragraph,

            'usuario_crea' => $userRandom->id,
            'usuario_solicita' => $userRandom->id,
            'usuario_autoriza' => null,
            'usuario_aprueba' => null,
            'usuario_despacha' => null,

            'firma_requiere' => null,
            'firma_autoriza' => null,
            'firma_aprueba' => null,
            'firma_almacen' => null,

            'fecha_solicita' => null,
            'fecha_autoriza' => null,
            'fecha_aprueba' => null,
            'fecha_despacha' => null,

            'fecha_almacen_firma' => null,
            'fecha_informa' => null,

            'envio_fiscal_id' => EnvioFiscal::SOLICITUD,

            'estado_id' => $this->faker->randomElement($estados),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Solicitud $solicitud) {

            $fechaSolicita = Carbon::now()->subDays(rand(0,3));
            $fechaAutoriza = $fechaSolicita->copy()->addHours(rand(2,5));
            $fechaAprueba = $fechaAutoriza->copy()->addHours(rand(2,5));
            $fechaDespacha = $fechaAprueba->copy()->addHours(rand(5,10));

            $solicitud->fecha_solicita = $fechaSolicita;


            if ($solicitud->estaAutoizada()) {
                $solicitud->autorizar($fechaAutoriza);
            }

            if ($solicitud->estaDespachada()) {
                $solicitud->autorizar($fechaAutoriza);
                sleep(1); // Simula un pequeño retraso para evitar conflictos de tiempo
                $solicitud->despachar($fechaDespacha);
            }

            if ($solicitud->estaAnulada()) {
                $solicitud->autorizar($fechaAutoriza);
                sleep(1); // Simula un pequeño retraso para evitar conflictos de tiempo
                $solicitud->despachar($fechaDespacha);
                sleep(1); // Simula un pequeño retraso para evitar conflictos de tiempo
                $solicitud->anular();
            }

            $solicitud->save();
        });
    }


}
