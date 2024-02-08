<?php

namespace Database\Factories;

use App\Models\EnvioFiscal;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnvioFiscalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EnvioFiscal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'nuemero_constancia' => $this->faker->randomDigitNotNull,
        'serie_constancia' => $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']),
        'fecha' => $this->faker->date('Y-m-d'),
        'numero_cuenta' => $this->faker->word,
        'forma' => $this->faker->word,
        'correlativo_del' => $this->faker->randomDigitNotNull,
        'correlativo_al' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->randomDigitNotNull,
        'pendientes' => $this->faker->randomDigitNotNull,
        'serie' => $this->faker->word,
        'numero' => $this->faker->word,
        'libro' => $this->faker->word,
        'folio' => $this->faker->randomDigitNotNull,
        'resolucion' => $this->faker->word,
        'numero_gestion' => $this->faker->word,
        'fecha_gestion' => $this->faker->date('Y-m-d'),
        'correlativo' => $this->faker->word,
        'activo' => 'si',
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
