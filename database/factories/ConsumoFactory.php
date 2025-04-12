<?php

namespace Database\Factories;

use App\Models\Consumo;
use App\Models\ConsumoEstado;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Consumo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * @var User $usuario
         */
        $usuario = User::where('id' ,'>',3)->get()->random();

        return [
            'correlativo' => $this->faker->randomDigitNotNull,
            'codigo' => $this->faker->word,
            'estado_id' => ConsumoEstado::all()->random()->id,
            'unidad_id' => $usuario->unidad_id,
            'bodega_id' => $usuario->bodega_id,
            'usuario_crea' => $usuario->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
