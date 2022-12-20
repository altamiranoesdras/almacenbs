<?php

namespace Database\Factories;

use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Item;
use App\Models\Renglon;
use Carbon\Carbon;
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

        /**
         * @var Item $item
         */
        $item = Item::tipoActivo()->get()->random();

        return [
            'nombre' => $item->nombre,
            'descripcion' => $item->descripcion,
            'codigo_inventario' => $this->faker->randomNumber(6),
            'folio' => $this->faker->randomNumber(4),
            'valor_actual' => $item->precio_compra,
            'valor_adquisicion' => $item->precio_compra,
            'valor_contabilizado' => 0,
            'fecha_registro' => Carbon::now()->subMonths(rand(1,5))->subDays(rand(5,20)),
            'tipo_id' => ActivoTipo::all()->random()->id,
            'estado_id' => ActivoEstado::BUEN_ESTADO,
            'detalle_1h_id' => null,
            'renglon_id' => Renglon::all()->random()->id,
            'entidad' => $this->faker->randomDigitNotNull,
            'unidad_ejecutadora' => $this->faker->randomDigitNotNull,
            'tipo_inventario' => $this->faker->randomDigitNotNull,
            'codigo_sicoin' => $this->faker->word,
            'codigo_donacion' => $this->faker->randomDigitNotNull,
            'nit' => $this->faker->word,
            'numero_documento' => $this->faker->word,
            'fecha_aprobado' => null,
            'fecha_contabilizacion' => null,
            'cur' => $this->faker->word,
            'contabilizado' => $this->faker->word,
            'diferencia_act_adq' => null,
            'diferencia_act_cont' => null,
            'diferencia_adq_cont' => null,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }

    public function configure()
    {
//        return $this->afterCreating(function (Activo $activo){
//            $this->faker->addProvider(new PicsumProvider($this->faker));
//            $this->faker->addProvider(new LoremSpaceProvider($this->faker));
//
//            try {
//
//                $categoria = $this->faker->randomElement([
//                    LoremSpaceProvider::CATEGORY_BOOK,
//                    LoremSpaceProvider::CATEGORY_SHOES,
//                    LoremSpaceProvider::CATEGORY_WATCH,
//                ]);
//
//                $url = $this->faker->loremSpace($categoria,storage_path('temp'));
//
//                $activo->addMedia($url)
//                    ->toMediaCollection('activos');
//
//            }catch (\Exception $exception){
//                dump($exception->getMessage());
//            }
//        });
    }
}
