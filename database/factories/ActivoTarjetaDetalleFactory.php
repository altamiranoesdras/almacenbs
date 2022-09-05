<?php

namespace Database\Factories;

use App\Models\Activo;
use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use App\Models\RrhhUnidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivoTarjetaDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivoTarjetaDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tarjeta_id' => ActivoTarjeta::all()->random()->id,
            'activo_id' => Activo::all()->random()->id,
            'tipo' => $this->faker->randomElement([ActivoTarjetaDetalle::ALZA,ActivoTarjetaDetalle::BAJA]),
            'cantidad' => 1,
            'valor' => $this->faker->randomFloat(2,500,5000),
            'unidad_id' => RrhhUnidad::all()->random()->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }
}
