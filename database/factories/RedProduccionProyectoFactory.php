<?php

namespace Database\Factories;

use App\Models\RedProduccionProyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RedProduccionSubPrograma;

class RedProduccionProyectoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionProyecto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $redProduccionSubPrograma = RedProduccionSubPrograma::first();
        if (!$redProduccionSubPrograma) {
            $redProduccionSubPrograma = RedProduccionSubPrograma::factory()->create();
        }

        return [
            'red_produccion_sub_programa_id' => $this->faker->word,
            'codigo' => $this->faker->lexify('?????'),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 500)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
