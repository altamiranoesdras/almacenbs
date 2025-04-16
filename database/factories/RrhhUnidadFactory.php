<?php

namespace Database\Factories;

use App\Models\RrhhUnidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class RrhhUnidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RrhhUnidad::class;

    public $unidades = [
        'Administración',
        'Contabilidad',
        'Recursos Humanos',
        'Producción',
        'Logística',
        'Ventas',
        'Marketing',
        'Calidad',
        'Investigación y Desarrollo',
        'Tecnología de la Información'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween(1000, 9999),
            'nombre' => $this->faker->randomElement($this->unidades),
            'activa' => $this->faker->randomElement(['si','no']),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
