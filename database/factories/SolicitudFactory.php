<?php

namespace Database\Factories;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitud::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'justificacion' => $this->faker->text,
        'unidad_id' => $this->faker->word,
        'usuario_crea' => $this->faker->word,
        'usuario_solicita' => $this->faker->word,
        'usuario_autoriza' => $this->faker->word,
        'usuario_aprueba' => $this->faker->word,
        'usuario_despacha' => $this->faker->word,
        'firma_requiere' => $this->faker->word,
        'firma_autoriza' => $this->faker->word,
        'firma_aprueba' => $this->faker->word,
        'firma_almacen' => $this->faker->word,
        'fecha_solicita' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_autoriza' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_aprueba' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_almacen_firma' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_informa' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_despacha' => $this->faker->date('Y-m-d H:i:s'),
        'estado_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
