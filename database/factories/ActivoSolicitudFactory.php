<?php

namespace Database\Factories;

use App\Models\ActivoSolicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoSolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoSolicitud::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tarjeta_id' => $this->faker->word,
        'tipo_id' => $this->faker->word,
        'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'usuario_origen' => $this->faker->word,
        'usuario_destino' => $this->faker->word,
        'usuario_autoriza' => $this->faker->word,
        'usuario_inventario' => $this->faker->word,
        'unidad_origen' => $this->faker->word,
        'unidad_destino' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'estado_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
