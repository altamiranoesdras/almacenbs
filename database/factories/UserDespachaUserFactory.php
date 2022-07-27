<?php

namespace Database\Factories;

use App\Models\UserDespachaUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDespachaUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDespachaUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_des' => $this->faker->word
        ];
    }
}
