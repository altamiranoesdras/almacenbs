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
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 500)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
