<?php

namespace Database\Factories;

use App\Models\EnvioFiscal;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnvioFiscalFactory extends Factory
{
    protected $model = EnvioFiscal::class;

    public function definition(): array
    {
        // Reglas lógicas
        $correlativoDel = $this->faker->numberBetween(1, 50_000);
        $correlativoAl  = $correlativoDel + $this->faker->numberBetween(0, 10_000);

        $folioInicial = $this->faker->numberBetween(1, 5_000);
        $folioActual  = $folioInicial + $this->faker->numberBetween(0, 5_000);

        return [



            'nombre_tabla'       => $this->faker->randomElement([
                'captacions', 'colocacions', 'pagos', 'ventas', 'envios'
            ]),
            'numero_resolucion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'correlativo_resolucion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha_correlativo_resolucion' => $this->faker->date('Y-m-d'),
            'serie_envio' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_envio' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha_envio' => $this->faker->date('Y-m-d'),

            'correlativo_del'    => $correlativoDel,
            'correlativo_al'     => $correlativoAl,

            'correlativo_inicial' => $correlativoDel,
            'correlativo_actual' => $folioActual,




            'libro'              => $this->faker->optional()->bothify('LIB-###'),
            'folio'              => $this->faker->optional()->numberBetween(1, 99_999),
            'activo'             => $this->faker->randomElement(['si', 'no']),
            // No setees created_at/updated_at: Eloquent los maneja.
            // 'deleted_at' => null, // softDeletes queda null por defecto



        ];
    }

    /** Estado activo (enum 'si') */
    public function activo(): self
    {
        return $this->state(fn () => ['activo' => 'si']);
    }

    /** Estado inactivo (enum 'no') */
    public function inactivo(): self
    {
        return $this->state(fn () => ['activo' => 'no']);
    }

    /** Con constancia poblada */
    public function conConstancia(): self
    {
        return $this->state(fn () => [
            'numero_constancia' => $this->faker->numberBetween(1, 999_999),
            'serie_constancia'   => $this->faker->bothify('SC-####'),
        ]);
    }
}
