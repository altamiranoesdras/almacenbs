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
        'serie_constancia' => $this->faker->word,
        'fecha' => $this->faker->word,
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
        'fecha_gestion' => $this->faker->word,
        'correlativo' => $this->faker->word,
        'activo' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
