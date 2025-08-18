<?php

namespace Database\Factories;

use App\Models\CostoCentro;
use Illuminate\Database\Eloquent\Factories\Factory;


class CostoCentroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CostoCentro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'padre_id' => $this->faker->word,
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 45))
        ];
    }
}
