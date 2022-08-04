<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\CompraEstado;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $fechaVence = Carbon::now()->addMonths(rand(3,16));

        return [
            'compra_id' => Compra::all()->random()->id,
            'item_id' => Item::all()->random()->id,
            'cantidad' => $this->faker->randomFloat(2,10,50),
            'precio' => $this->faker->randomFloat(2,50,200),
            'descuento' => 0,
            'fecha_vence' => $fechaVence,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (CompraDetalle $detalle){

            if ($detalle->compra->estado_id==CompraEstado::RECIBIDA){
                $detalle->ingreso();
            }


            if ($detalle->compra->estado_id==CompraEstado::ANULADA){
                $detalle->anular();
            }
        });

    }


}
