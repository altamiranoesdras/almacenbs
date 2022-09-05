<?php

namespace Database\Factories;

use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoTarjetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoTarjeta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'responsable_id' => User::all()->random(),
            'codigo' => null,
            'correlativo' => null,
            'created_at' => Carbon::now()->subMonths(rand(1,5)),
            'updated_at' => Carbon::now()->subMonths(rand(1,5)),
        ];
    }

}
