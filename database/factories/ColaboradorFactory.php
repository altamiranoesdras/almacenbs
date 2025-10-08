<?php

namespace Database\Factories;

use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColaboradorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Colaborador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->word,
        'apellidos' => $this->faker->word,
        'dpi' => $this->faker->word,
        'correo' => $this->faker->word,
        'telefono' => $this->faker->word,
        'direccion' => $this->faker->text,
        'nit' => $this->faker->word,
        'puesto_id' => $this->faker->word,
        'unidad_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
