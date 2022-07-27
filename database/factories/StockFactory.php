<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => $this->faker->word,
        'lote' => $this->faker->word,
        'fecha_ing' => $this->faker->date('Y-m-d H:i:s'),
        'fecha_vence' => $this->faker->word,
        'precio_compra' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'cantidad_inicial' => $this->faker->word,
        'orden_salida' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
