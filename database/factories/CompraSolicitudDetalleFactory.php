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
        
        $compraSolicitude = CompraSolicitude::first();
        if (!$compraSolicitude) {
            $compraSolicitude = CompraSolicitude::factory()->create();
        }

        return [
            'solicitud_id' => $this->faker->word,
            'item_id' => $this->faker->word,
            'cantidad' => $this->faker->word,
            'precio_venta' => $this->faker->numberBetween(0, 9223372036854775807),
            'precio_compra' => $this->faker->numberBetween(0, 9223372036854775807),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
