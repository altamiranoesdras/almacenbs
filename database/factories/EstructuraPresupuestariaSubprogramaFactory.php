<?php

namespace Database\Factories;

use App\Models\EstructuraPresupuestariaSubprograma;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EstructuraPresupuestariaPrograma;

class EstructuraPresupuestariaSubprogramaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstructuraPresupuestariaSubprograma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::first();
        if (!$estructuraPresupuestariaPrograma) {
            $estructuraPresupuestariaPrograma = EstructuraPresupuestariaPrograma::factory()->create();
        }

        return [
            'programa_id' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
