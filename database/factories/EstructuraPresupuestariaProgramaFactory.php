<?php

namespace Database\Factories;

use App\Models\EstructuraPresupuestariaPrograma;
use Illuminate\Database\Eloquent\Factories\Factory;


class EstructuraPresupuestariaProgramaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstructuraPresupuestariaPrograma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //ejemplo 0001
            'codigo' => $this->faker->unique()->numerify('####'),
            'nombre' => $this->faker->sentence($this->faker->numberBetween(1, 3)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
