<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemCategoria;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Unimed;
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

        $precio_compra = $this->faker->randomFloat(2,10,50);
        $precio_venta = $precio_compra * 1.3;

        return [
            'codigo' => $this->faker->unique()->randomNumber(5),
            'nombre' => $this->faker->randomElement(['Cheese Pizza', 'Hamburger', 'Cheeseburger', 'Bacon Burger', 'Bacon Cheeseburger',
                'Little Hamburger', 'Little Cheeseburger', 'Little Bacon Burger', 'Little Bacon Cheeseburger',
                'Veggie Sandwich', 'Cheese Veggie Sandwich', 'Grilled Cheese',
                'Cheese Dog', 'Bacon Dog', 'Bacon Cheese Dog', 'Pasta', 'Beer', 'Bud Light', 'Budweiser', 'Miller Lite',
                'Milk Shake', 'Tea', ' Sweet Tea', 'Coffee', 'Hot Tea',
                'Champagne', 'Wine', 'Limonade', 'Coca_cola', 'Diet-Coke',
                'Water', 'Sprite', 'Orange Juice', 'Iced Coffee'
            ]),
            'descripcion' => $this->faker->paragraph,
            'renglon_id' => Renglon::all()->random()->id,
            'marca_id' => Marca::all()->random()->id,
            'unimed_id' => Unimed::all()->random()->id,
            'categoria_id' => ItemCategoria::all()->random()->id,
            'precio_venta' => $precio_venta,
            'precio_compra' => $precio_compra,
            'precio_promedio' => $precio_compra,
            'stock_minimo' => rand(10,25),
            'stock_maximo' => rand(10,25),
            'ubicacion' => $this->faker->word,
            'perecedero' => rand(0,1),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
