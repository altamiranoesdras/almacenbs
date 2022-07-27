<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->word,
        'nombre' => $this->faker->word,
        'descripcion' => $this->faker->text,
        'renglon_id' => $this->faker->word,
        'marca_id' => $this->faker->word,
        'unimed_id' => $this->faker->word,
        'categoria_id' => $this->faker->word,
        'precio_venta' => $this->faker->word,
        'precio_compra' => $this->faker->word,
        'precio_promedio' => $this->faker->word,
        'stock_minimo' => $this->faker->word,
        'stock_maximo' => $this->faker->word,
        'ubicacion' => $this->faker->word,
        'perecedero' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
