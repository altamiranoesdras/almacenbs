<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SolicitudDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * @var Item $item
         */
        $item = Item::limit(2)->whereHas('stocks', function ($query) {
            $query->where('cantidad', '>', 0);
        })->inRandomOrder()->first();

        $cantidadSolicitada = rand(5,10);
        $cantidadDespachada = $cantidadSolicitada - rand(0,2);

        return [
            'solicitud_id' => Solicitud::all()->random()->id,
            'item_id' => $item->id,
            'cantidad_solicitada' => $cantidadSolicitada,
            'cantidad_autorizada' => $cantidadSolicitada,
            'cantidad_despachada' => $cantidadDespachada,
            'precio' => $item->precio_compra,
            'observaciones' => $this->faker->text(100),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
