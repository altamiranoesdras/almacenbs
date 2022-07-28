<?php

namespace Database\Factories;

use App\Models\Equivalencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquivalenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Equivalencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_origen' => $this->faker->word,
        'item_destino' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
