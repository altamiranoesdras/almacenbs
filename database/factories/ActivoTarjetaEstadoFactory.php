<?php

namespace Database\Factories;

use App\Models\ActivoTarjetaEstado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoTarjetaEstadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoTarjetaEstado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
