<?php

namespace Database\Factories;

use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CompraRequisicione;
use App\Models\CompraSolicitudDetalle;
use App\Models\Item;

class CompraRequisicionDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraRequisicionDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
            'requisicion_id' => CompraRequisicion::all()->random()->id,
            'solicitud_detalle_id' => CompraSolicitudDetalle::all()->random()->id,
            'item_id' => Item::limit(1000)->get()->random()->id,
            'cantidad' => $this->faker->numberBetween(0, 9223372036854775807),
            'precio_estimado' => $this->faker->numberBetween(0, 9223372036854775807),
            'observaciones' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
