<?php

namespace Database\Factories;

use App\Models\CompraSolicitudDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CompraSolicitud;
use App\Models\Item;

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

        return [
            'solicitud_id' => CompraSolicitud::all()->random()->id,
            'item_id' => Item::all()->random()->id,
            'cantidad' => $this->faker->numberBetween(1,150),
            'precio_estimado' => $this->faker->numberBetween(500, 3000),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
