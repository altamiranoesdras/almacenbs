<?php

namespace Database\Factories;

use App\Models\CompraSolicitudDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Item;
use App\Models\CompraSolicitude;

class CompraSolicitudDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraSolicitudDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $precioVenta = $this->faker->numberBetween(500, 3000);
        $precioCompra = $precioVenta / 1.20;


        return [
            'solicitud_id' => $this->faker->word,
            'item_id' => Item::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1,150),
            'precio_venta' => $precioVenta,
            'precio_compra' => $precioCompra,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
