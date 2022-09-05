<?php

namespace Database\Factories;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mmo\Faker\LoremSpaceProvider;
use Mmo\Faker\PicsumProvider;

class ActivoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->paragraph,
            'codigo_inventario' => $this->faker->randomNumber(6),
            'folio' => $this->faker->randomNumber(4),
            'valor' => $this->faker->randomFloat(2,1000,10000),
            'fecha_registra' => $this->faker->date,
            'tipo_id' => ActivoTipo::all()->random()->id,
            'estado_id' => ActivoEstado::all()->random()->id,
            'detalle_1h_id' => null,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Activo $activo){
            $this->faker->addProvider(new PicsumProvider($this->faker));
            $this->faker->addProvider(new LoremSpaceProvider($this->faker));

            try {

                $categoria = $this->faker->randomElement([
                    LoremSpaceProvider::CATEGORY_BOOK,
                    LoremSpaceProvider::CATEGORY_SHOES,
                    LoremSpaceProvider::CATEGORY_WATCH,
                ]);

                $url = $this->faker->loremSpace($categoria,storage_path('temp'));

                $activo->addMedia($url)
                    ->toMediaCollection('activos');

            }catch (\Exception $exception){
                dump($exception->getMessage());
            }
        });
    }
}
