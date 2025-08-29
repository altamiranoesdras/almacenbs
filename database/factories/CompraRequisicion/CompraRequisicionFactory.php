<?php

namespace Database\Factories\CompraRequisicion;

use App\Models\CompraRequisicion\CompraRequisicionEstado;
use App\Models\CompraRequisicionTipoAdquisicion;
use App\Models\CompraRequisicionTipoConcurso;
use App\Models\Proveedor;
use App\Models\RrhhUnidad;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CompraRequisicion\CompraRequisicion;

class CompraRequisicionFactory extends Factory
{
    protected $model = CompraRequisicion::class;

    public function definition(): array
    {
        $year = (int) now()->format('Y');

        // Formatos ajustados a longitudes
        $codigo = sprintf('G-%d-%s', $year, Str::padLeft((string) $this->faker->numberBetween(1, 9999), 3, '0'));           // <= 20
        $codigoConsolidacion = sprintf('L-%d-%s', $year, Str::padLeft((string) $this->faker->numberBetween(1, 99999), 3, '0')); // <= 45

        // Campos opcionales (nullable) con formato corto
        $npg = $this->faker->optional(40)->bothify('NPG-########'); // <= 45
        $nog = $this->faker->optional(40)->bothify('NOG-########'); // <= 45

        // Listas cortas en string para subproductos/partidas
        $subproductos = $this->faker->optional(40)->randomElements(range(100, 999), $this->faker->numberBetween(1, 4));
        $partidas = $this->faker->optional(40)->randomElements(['131', '141', '151', '263', '311', '321'], $this->faker->numberBetween(1, 4));

        return [
            // FK nullable
            'tipo_concurso_id'   => CompraRequisicionTipoConcurso::all()->random()->id,
            'tipo_adquisicion_id' => CompraRequisicionTipoAdquisicion::all()->random()->id,

            // Numérico
            'correlativo' => $this->faker->optional(30)->numberBetween(1, 999999),

            // Strings con longitudes específicas
            'codigo'               => Str::limit($codigo, 20, ''),                 // varchar(20)
            'codigo_consolidacion' => Str::limit($codigoConsolidacion, 45, ''),    // varchar(45)
            'npg'                  => $npg ? Str::limit($npg, 45, '') : null,      // varchar(45) nullable
            'nog'                  => $nog ? Str::limit($nog, 45, '') : null,      // varchar(45) nullable

            // Usuarios (algunos nullable)
            'usuario_crea_id'     => User::all()->random()->id, // NOT NULL
            'usuario_aprueba_id'  => User::all()->random()->id,
            'usuario_autoriza_id' => User::all()->random()->id,
            'usuario_asigna_id'   => User::all()->random()->id,
            'usuario_analista_id' => User::all()->random()->id,

            // Unidad (NOT NULL)
            'unidad_id' => RrhhUnidad::all()->random()->id,

            // Proveedor adjudicado (nullable)
            'proveedor_adjudicado' => Proveedor::all()->random()->id,

            // Otros strings
            'numero_adjudicacion' => $this->faker->optional(40)->bothify('ADJ-########'),

            // Estado (NOT NULL)
            'estado_id' => CompraRequisicionEstado::all()->random()->id,

            // Strings (listas separadas por coma) y textos
            'subproductos'  => isset($subproductos) && $subproductos ? implode(',', $subproductos) : null,
            'partidas'      => isset($partidas) && $partidas ? implode(',', $partidas) : null,
            'observaciones' => $this->faker->optional(50)->paragraphs($this->faker->numberBetween(1, 3), true),
            'justificacion' => $this->faker->optional(50)->paragraphs($this->faker->numberBetween(1, 3), true),
            // timestamps y softDeletes los maneja Laravel automáticamente
        ];
    }
}
