<?php

namespace Database\Factories;

use App\Models\RedProduccionProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\RedProduccionResultado;

class RedProduccionProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionProducto::class;

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
            'resultado_id' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
