<?php

namespace Database\Factories;

use App\Models\ActivoTarjeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoTarjetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoTarjeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'responsable_id' => $this->faker->word,
        'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
