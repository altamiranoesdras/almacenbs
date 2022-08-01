<?php

namespace Database\Factories;

use App\Models\Renglon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RenglonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Renglon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero' => $this->faker->unique()->randomElement(['091','080','029','011','175','098','099','100','122','200']),
            'descripcion' => $this->faker->text,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
