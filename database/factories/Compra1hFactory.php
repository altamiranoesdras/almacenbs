<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\Compra1h;
use App\Models\User;
use Carbon\Carbon;
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
            'compra_id' => Compra::all()->random()->id,
            'envio_fiscal_id' => 1,
            'codigo' => null,
            'correlativo' => null,
            'del' => 1,
            'al' => 10,
            'fecha_procesa' => null,
            'usuario_procesa' => User::PRINCIPAL,
            'observaciones' => $this->faker->text,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
