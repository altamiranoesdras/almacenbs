<?php

namespace Database\Factories;

use App\Models\Compra1h;
use App\Models\Compra1hDetalle;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class Compra1hDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compra1hDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * @var Item $item
         */
        $item = Item::all()->random();

        return [
            '1h_id' => Compra1h::all()->random()->id,
            'item_id' => $item->id,
            'precio' => $item->precio_compra,
            'cantidad' => 1,
            'folio_almacen' => $this->faker->randomNumber(4),
            'folio_inventario' => $this->faker->randomNumber(4),
            'codigo_inventario' => $this->faker->randomNumber(4),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
