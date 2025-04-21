<?php

namespace Database\Factories;

use App\Models\RrhhPuesto;
use Illuminate\Database\Eloquent\Factories\Factory;

class RrhhPuestoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RrhhPuesto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $puestos = $this->puestos();
        $puestoRandom = array_rand($puestos);
        $atribuciones = $puestos[$puestoRandom];

        return [
            'nombre' => $puestoRandom,
            'atribuciones' => $atribuciones,
            'activo' => $this->faker->randomElement(['si','no']),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),

        ];
    }

    public function puestos()
    {
        return [
            'Auxiliar Administrativo' => "Encargado de la gestión administrativa y apoyo a los procesos internos.",
            'Asistente de Recursos Humanos' => "Colabora en la gestión del personal y procesos de selección.",
            'Analista de Recursos Humanos' => "Responsable de la gestión del talento humano y desarrollo organizacional.",
            'Coordinador de Recursos Humanos' => "Coordina y supervisa las actividades del departamento de recursos humanos.",
            'Gerente de Recursos Humanos' => "Lidera la estrategia de gestión del talento humano en la organización.",
            'Soporte de tecnología de la información' => "Proporciona asistencia técnica y soporte a los usuarios de tecnología.",
            'Auxiliar de contabilidad' => "Asiste en la gestión contable y financiera de la empresa.",
            'Analista de contabilidad' => "Responsable de la elaboración y análisis de informes contables.",
            'Contador' => "Encargado de la gestión contable y fiscal de la organización.",
            'Arquitecto de software' => "Diseña y supervisa la arquitectura de software de los sistemas.",
            'Desarrollador de software' => "Crea y mantiene aplicaciones y sistemas informáticos.",
            'Analista de sistemas' => "Analiza y mejora los sistemas informáticos de la organización.",
            'Ingeniero de sistemas' => "Diseña y desarrolla soluciones tecnológicas para la empresa.",
            'Consejero de ventas' => "Asesora a los clientes en la compra de productos y servicios.",
            'Gerente de ventas' => "Lidera el equipo de ventas y establece estrategias comerciales.",
            'Asistente de ventas' => "Apoya al equipo de ventas en la gestión de clientes y procesos comerciales.",
        ];

    }

}
