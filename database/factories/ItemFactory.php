<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ItemCategoria;
use App\Models\ItemTipo;
use App\Models\Marca;
use App\Models\Renglon;
use App\Models\Unimed;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mmo\Faker\LoremSpaceProvider;
use Mmo\Faker\PicsumProvider;

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

        $nombres = include(app_path("Faker/items.php"));


        return [
            'codigo' => $this->faker->unique()->randomNumber(5),
            'nombre' => $this->faker->randomElement($nombres),
            'descripcion' => $this->faker->paragraph,
            'tipo_id' => ItemTipo::all()->random()->id,
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
            'inventariable' => 1,
            'perecedero' => rand(0,1),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }

    public function configure()
    {

        return $this->afterCreating(function (Item $item){


            $stock = rand(20,40);
            $fechaVence = Carbon::now()->addMonths(rand(4,12))->format('Y-m-d');

            $item->actualizaOregistraStcokInicial($stock,$fechaVence);

            $item->categorias()->attach(ItemCategoria::pluck('id')->random(4));

            $this->imagen($item);


        });
    }

    public function imagen(Item $item)
    {
        $this->faker->addProvider(new PicsumProvider($this->faker));
        $this->faker->addProvider(new LoremSpaceProvider($this->faker));

        try {

            $categoria = $this->faker->randomElement([
                LoremSpaceProvider::CATEGORY_ALBUM,
                LoremSpaceProvider::CATEGORY_BOOK,
//                LoremSpaceProvider::CATEGORY_FASHION,
                LoremSpaceProvider::CATEGORY_SHOES,
                LoremSpaceProvider::CATEGORY_WATCH,
            ]);

            $url = $this->faker->loremSpace($categoria,storage_path('temp'));

            $item->addMedia($url)
                ->toMediaCollection('items');

        }catch (\Exception $exception){
            dump($exception->getMessage());
        }

    }


}
