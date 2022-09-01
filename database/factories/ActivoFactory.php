<?php

namespace Database\Factories;

use App\Models\Activo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo_inventario' => $this->faker->word,
        'folio' => $this->faker->word,
        'descripcion' => $this->faker->text,
        'valor' => $this->faker->word,
        'fecha_registra' => $this->faker->word,
        'tipo_id' => $this->faker->word,
        'detalle_1h_id' => $this->faker->word,
        'estado_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
