<?php

namespace Database\Factories;

use App\Models\ItemTraslado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemTrasladoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemTraslado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->word,
        'correlativo' => $this->faker->randomDigitNotNull,
        'item_origen' => $this->faker->word,
        'cantidad_origen' => $this->faker->word,
        'item_destino' => $this->faker->word,
        'cantidad_destino' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'user_id' => $this->faker->word,
        'estado_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
