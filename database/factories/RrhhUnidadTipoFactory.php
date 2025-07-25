<?php

namespace Database\Factories;

use App\Models\RrhhUnidadTipo;
use Illuminate\Database\Eloquent\Factories\Factory;


class RrhhUnidadTipoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RrhhUnidadTipo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nivel' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
