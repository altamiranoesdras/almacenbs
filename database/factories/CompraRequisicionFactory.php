<?php

namespace Database\Factories;

use App\Models\CompraRequisicion\CompraRequisicion;
use App\Models\CompraRequisicionEstado;
use App\Models\CompraRequisicionTipoAdquisicione;
use App\Models\Proveedore;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraRequisicionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompraRequisicion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $compraRequisicionEstado = CompraRequisicionEstado::first();
        if (!$compraRequisicionEstado) {
            $compraRequisicionEstado = CompraRequisicionEstado::factory()->create();
        }

        return [
            'tipo_concurso_id' => $this->faker->word,
            'ipo_adquisicion_id' => $this->faker->word,
            'correlativo' => $this->faker->word,
            'codigo' => $this->faker->text($this->faker->numberBetween(5, 20)),
            'codigo_consolidacion' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'npg' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'nog' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'proveedor_adjudicado' => $this->faker->word,
            'numero_adjudicacion' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'estado_id' => $this->faker->word,
            'subproductos' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'partidas' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'observaciones' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'justificacion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
