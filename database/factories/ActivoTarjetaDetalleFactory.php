<?php

namespace Database\Factories;

use App\Models\ActivoTarjetaDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoTarjetaDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoTarjetaDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tarjeta_id' => $this->faker->word,
        'activo_id' => $this->faker->word,
        'tipo' => $this->faker->word,
        'cantidad' => $this->faker->randomDigitNotNull,
        'valor' => $this->faker->word,
        'unidad_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
