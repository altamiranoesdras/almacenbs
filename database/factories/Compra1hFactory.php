<?php

namespace Database\Factories;

use App\Models\Compra1h;
use Illuminate\Database\Eloquent\Factories\Factory;

class Compra1hFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Compra1h::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'compra_id' => $this->faker->word,
        'envio_fiscal_id' => $this->faker->word,
        'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'del' => $this->faker->randomDigitNotNull,
        'al' => $this->faker->randomDigitNotNull,
        'fecha_procesa' => $this->faker->date('Y-m-d H:i:s'),
        'usuario_procesa' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
