<?php

namespace Database\Factories;

use App\Models\RedProduccionUnidade;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RedProduccionSubProducto;
use App\Models\RrhhUnidade;

class RedProduccionUnidadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionUnidade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $rrhhUnidade = RrhhUnidade::first();
        if (!$rrhhUnidade) {
            $rrhhUnidade = RrhhUnidade::factory()->create();
        }

        return [
            'rrhh_unidades_id' => $this->faker->word
        ];
    }
}
