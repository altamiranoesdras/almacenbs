<?php

namespace Database\Factories;

use App\Models\Consumo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Consumo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'correlativo' => $this->faker->randomDigitNotNull,
        'codigo' => $this->faker->word,
        'estado_id' => $this->faker->word,
        'usuario_crea' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
