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

            'correlativo_del'    => $correlativoDel,
            'correlativo_al'     => $correlativoAl,

            'folio_inicial'      => $folioInicial,
            'folio_actual'       => $folioActual,

            // OJO: el schema tiene "nuemero_constancia" (con u). Mantener mientras no se renombre.
            'nuemero_constancia' => $this->faker->optional()->numberBetween(1, 999_999),
            'serie_constancia'   => $this->faker->optional()->bothify('SC-####'),

            'fecha'              => $this->faker->optional()->date('Y-m-d'),

            'numero_cuenta'      => $this->faker->optional()->bothify('############'),
            'forma'              => $this->faker->optional()->randomElement(['Factura','Recibo','Nota de crédito']),
            'serie'              => $this->faker->optional()->bothify('??-###'),
            'numero'             => $this->faker->optional()->bothify('########'),
            'libro'              => $this->faker->optional()->bothify('LIB-###'),
            'folio'              => $this->faker->optional()->numberBetween(1, 99_999),

            'resolucion'         => $this->faker->optional()->bothify('RES-####/####'),
            'numero_gestion'     => $this->faker->optional()->bothify('GES-########'),
            'fecha_gestion'      => $this->faker->optional()->date('Y-m-d'),

            'correlativo'        => $this->faker->optional()->bothify('CORR-########'),

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
            'nuemero_constancia' => $this->faker->numberBetween(1, 999_999),
            'serie_constancia'   => $this->faker->bothify('SC-####'),
        ]);
    }
}
