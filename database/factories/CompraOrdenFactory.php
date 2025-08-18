<?php

namespace Database\Factories;

use App\Models\CompraOrden;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CompraRequisicione;
use App\Models\Proveedore;

class CompraOrdenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraOrden::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $proveedore = Proveedore::first();
        if (!$proveedore) {
            $proveedore = Proveedore::factory()->create();
        }

        return [
            'gestion_id' => $this->faker->word,
            'proveedor_id' => $this->faker->word,
            'numero' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'fecha' => $this->faker->date('Y-m-d H:i:s'),
            'estado' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'observaciones' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
