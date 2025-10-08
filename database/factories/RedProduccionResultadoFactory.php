<?php

namespace Database\Factories;

use App\Models\RedProduccionResultado;
use Illuminate\Database\Eloquent\Factories\Factory;


class RedProduccionResultadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RedProduccionResultado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //ejem 00-0001
            'codigo' => $this->faker->unique()->numerify('00-####'),
            'nombre' => $this->faker->paragraph,
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
