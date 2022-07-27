<?php

namespace Database\Factories;

use App\Models\StockTransaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockTransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockTransaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model_type' => $this->faker->word,
        'model_id' => $this->faker->word,
        'stock_id' => $this->faker->word,
        'tipo' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'precio_costo' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
