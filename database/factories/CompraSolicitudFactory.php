<?php

namespace Database\Factories;

use App\Models\CompraSolicitud;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Bodega;
use App\Models\CompraSolicitudEstado;
use App\Models\Proveedor;
use App\Models\User;

class CompraSolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraSolicitud::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'bodega_id' => $this->faker->word,
            'proveedor_id' => $this->faker->word,
            'correlativo' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 10)),
            'fecha_requiere' => $this->faker->date('Y-m-d'),
            'observaciones' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'estado_id' => $this->faker->word,
            'usuario_solicita' => $this->faker->word,
            'usuario_aprueba' => $this->faker->word,
            'usuario_administra' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
