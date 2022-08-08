<?php

namespace Database\Factories;

use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Mmo\Faker\LoremSpaceProvider;
use Mmo\Faker\PicsumProvider;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'name' => $this->faker->name,
            'dpi' => rand(123456789012345, 999999999999999),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt(123), // password
            'unidad_id' => RrhhUnidad::all()->random()->id,
            'puesto_id' => RrhhPuesto::all()->random()->id,
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user){

            $this->faker->addProvider(new PicsumProvider($this->faker));
            $this->faker->addProvider(new LoremSpaceProvider($this->faker));

            try {

                $url = $this->faker->loremSpace(LoremSpaceProvider::CATEGORY_FACE,storage_path('temp'));

                $user->addMedia($url)
                    ->toMediaCollection('avatars');

            }catch (\Exception $exception){
                dump($exception->getMessage());
            }
        });
    }


}
