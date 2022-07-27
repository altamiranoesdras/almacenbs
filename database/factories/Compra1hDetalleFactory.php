<?php

namespace Database\Factories;

use App\Models\Compra1hDetalle;
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
        return [
            '1h_id' => $this->faker->word,
        'item_id' => $this->faker->word,
        'precio' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'folio_almacen' => $this->faker->randomDigitNotNull,
        'folio_inventario' => $this->faker->randomDigitNotNull,
        'codigo_inventario' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
