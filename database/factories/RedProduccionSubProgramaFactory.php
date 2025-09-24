<?php

namespace Database\Factories;

use App\Models\RedProduccionSubPrograma;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RedProduccionPrograma;

class RedProduccionSubProgramaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionSubPrograma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $redProduccionPrograma = RedProduccionPrograma::first();
        if (!$redProduccionPrograma) {
            $redProduccionPrograma = RedProduccionPrograma::factory()->create();
        }

        return [
            'red_produccion_programa_id' => $this->faker->word,
            'codigo' => $this->faker->lexify('?????'),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 500)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
