<?php

namespace Database\Factories;

use App\Models\EstructuraPresupuestariaActividad;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EstructuraPresupuestariaProyecto;

class EstructuraPresupuestariaActividadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstructuraPresupuestariaActividad::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'proyecto_id' => EstructuraPresupuestariaProyecto::all()->random()->id,
            'codigo' => $this->faker->unique()->numerify('####'),
            'nombre' => $this->faker->sentence($this->faker->numberBetween(1, 3)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
