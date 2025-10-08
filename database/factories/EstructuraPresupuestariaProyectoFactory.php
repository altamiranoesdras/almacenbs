<?php

namespace Database\Factories;

use App\Models\EstructuraPresupuestariaProyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EstructuraPresupuestariaSubprograma;

class EstructuraPresupuestariaProyectoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstructuraPresupuestariaProyecto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::first();
        if (!$estructuraPresupuestariaSubprograma) {
            $estructuraPresupuestariaSubprograma = EstructuraPresupuestariaSubprograma::factory()->create();
        }

        return [
            'subprograma_id' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
