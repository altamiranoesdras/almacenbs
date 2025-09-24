<?php

namespace Database\Factories;

use App\Models\RedProduccionPrograma;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RedProduccionResultado;

class RedProduccionProgramaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionPrograma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $redProduccionResultado = RedProduccionResultado::first();
        if (!$redProduccionResultado) {
            $redProduccionResultado = RedProduccionResultado::factory()->create();
        }

        return [
            'red_produccion_resultado_id' => $this->faker->word,
            'codigo' => $this->faker->lexify('?????'),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 500)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
