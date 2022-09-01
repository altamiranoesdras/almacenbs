<?php

namespace Database\Factories;

use App\Models\ActivoSolicitudDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoSolicitudDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoSolicitudDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'solicitud_id' => $this->faker->word,
        'activo_id' => $this->faker->word,
        'estado_id' => $this->faker->word,
        'solicitud_tipo_id' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
