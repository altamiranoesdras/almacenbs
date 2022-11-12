<?php

namespace Database\Factories;

use App\Models\Activo;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'descripcion' => $this->faker->text,
            'codigo_inventario' => $this->faker->word,
            'folio' => $this->faker->word,
            'valor_actual' => $this->faker->word,
            'valor_adquisicion' => $this->faker->word,
            'valor_contabilizado' => $this->faker->word,
            'fecha_registro' => $this->faker->word,
            'tipo_id' => $this->faker->word,
            'estado_id' => $this->faker->word,
            'detalle_1h_id' => $this->faker->word,
            'renglon_id' => $this->faker->word,
            'entidad' => $this->faker->randomDigitNotNull,
            'unidad_ejecutadora' => $this->faker->randomDigitNotNull,
            'tipo_inventario' => $this->faker->randomDigitNotNull,
            'codigo_sicoin' => $this->faker->word,
            'codigo_donacion' => $this->faker->randomDigitNotNull,
            'nit' => $this->faker->word,
            'numero_documento' => $this->faker->word,
            'fecha_aprobado' => $this->faker->word,
            'fecha_contabilizacion' => $this->faker->word,
            'cur' => $this->faker->word,
            'contabilizado' => $this->faker->word,
            'diferencia_act_adq' => $this->faker->randomDigitNotNull,
            'diferencia_act_cont' => $this->faker->randomDigitNotNull,
            'diferencia_adq_cont' => $this->faker->randomDigitNotNull,
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
