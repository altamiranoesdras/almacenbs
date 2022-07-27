<?php

namespace Database\Factories;

use App\Models\Kardex;
use Illuminate\Database\Eloquent\Factories\Factory;

class KardexFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kardex::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => $this->faker->word,
        'model_id' => $this->faker->randomDigitNotNull,
        'model_type' => $this->faker->word,
        'cantidad' => $this->faker->word,
        'tipo' => $this->faker->word,
        'codigo' => $this->faker->word,
        'responsable' => $this->faker->word,
        'observacion' => $this->faker->text,
        'impreso' => $this->faker->word,
        'usuario_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
