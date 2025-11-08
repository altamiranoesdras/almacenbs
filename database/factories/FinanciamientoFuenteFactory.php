<?php

namespace Database\Factories;

use App\Models\FinanciamientoFuente;
use Illuminate\Database\Eloquent\Factories\Factory;


class FinanciamientoFuenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinanciamientoFuente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'codigo_fuente' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'codigo_organismo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'correlativo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
