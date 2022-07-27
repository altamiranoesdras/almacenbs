<?php

namespace Database\Factories;

use App\Models\Compra;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo_id' => $this->faker->word,
        'proveedor_id' => $this->faker->word,
        'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'fecha_documento' => $this->faker->word,
        'fecha_ingreso' => $this->faker->word,
        'serie' => $this->faker->word,
        'numero' => $this->faker->word,
        'estado_id' => $this->faker->word,
        'usuario_crea' => $this->faker->word,
        'usuario_recibe' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
