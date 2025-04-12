<?php

namespace Database\Factories;

use App\Models\Consumo;
use App\Models\ConsumoDetalle;
use App\Models\ConsumoEstado;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumoDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConsumoDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $fechaVence = Carbon::now()->addMonths(rand(3,16));

        /**
         * @var Item $item
         */
        $item = Item::limit(1000)->get()->random();

        return [
            'consumo_id' => Consumo::all()->random()->id,
            'item_id' => $item->id,
            'cantidad' => $this->faker->randomFloat(2,10,50),
            'precio' => $item->precio_compra,
            'fecha_vence' => Carbon::now()->addYear()->format('Y-m-d'),
            'observaciones' => $this->faker->text,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (ConsumoDetalle $detalle){

            if ($detalle->consumo->estado_id==ConsumoEstado::PROCESADO){
                $detalle->egreso();
            }


            if ($detalle->consumo->estado_id==ConsumoEstado::ANULADO){
                $detalle->anular();
            }
        });

    }
}
