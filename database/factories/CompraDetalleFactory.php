<?php

namespace Database\Factories;

use App\Models\CompraDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'compra_id' => $this->faker->word,
        'item_id' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'precio' => $this->faker->word,
        'descuento' => $this->faker->word,
        'fecha_ven' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
