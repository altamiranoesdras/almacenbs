<?php

namespace Database\Factories;

use App\Models\RrhhPuesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class RrhhPuestoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RrhhPuesto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'atribuciones' => $this->faker->text,
            'activo' => $this->faker->randomElement(['si','no']),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
