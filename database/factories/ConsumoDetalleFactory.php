<?php

namespace Database\Factories;

use App\Models\ConsumoDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumoDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConsumoDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'consumo_id' => $this->faker->word,
        'item_id' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'precio' => $this->faker->word,
        'fecha_vence' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
