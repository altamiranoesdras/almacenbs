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
        $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::first();
        if (!$estructuraPresupuestariaProyecto) {
            $estructuraPresupuestariaProyecto = EstructuraPresupuestariaProyecto::factory()->create();
        }

        return [
            'proyecto_id' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
