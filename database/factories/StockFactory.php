<?php

namespace Database\Factories;

use App\Models\Item;
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
        $cantidad = rand(20,70);

        $fechaVence = \Carbon\Carbon::now()->addMonth(5);

        $fechaVence = $fechaVence->subDay(rand(5,25));

        return [
            'item_id' => Item::all()->random()->id,
            'lote' => $this->faker->word,
            'fecha_ing' => $this->faker->date('Y-m-d H:i:s'),
            'fecha_vence' => $fechaVence,
            'precio_compra' => 0,
            'cantidad' => $cantidad,
            'cantidad_inicial' => $cantidad,
            'orden_salida' => 1,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
