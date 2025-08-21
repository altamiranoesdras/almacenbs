<?php

namespace Database\Factories\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicionEstado;
use Illuminate\Database\Eloquent\Factories\Factory;


class CompraRequisicionEstadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraRequisicionEstado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tipo_proceso' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
