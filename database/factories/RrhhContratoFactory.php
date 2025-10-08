<?php

namespace Database\Factories;

use App\Models\RrhhContrato;
use Illuminate\Database\Eloquent\Factories\Factory;

class RrhhContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RrhhContrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'colaborador_id' => $this->faker->word,
        'unidad_id' => $this->faker->word,
        'puesto_id' => $this->faker->word,
        'numero' => $this->faker->word,
        'inicio' => $this->faker->word,
        'fin' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
