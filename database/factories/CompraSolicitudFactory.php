<?php

namespace Database\Factories;

use App\Models\CompraSolicitud;
use Carbon\Carbon;
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

        $user = User::all()->random();

        $fechaCrea = Carbon::now()->subDays(rand(0,30));


        return [
            'unidad_id' => $user->unidad_id,
            'bodega_id' => $user->bodega_id,
            'proveedor_id' => Proveedor::all()->random()->id,
            'fecha_requiere' => $fechaCrea->copy()->addDays(rand(0,3)),
            'justificacion' => $this->faker->text,
            'estado_id' => CompraSolicitudEstado::all()->random()->id,
            'usuario_solicita' => $user->id,
            'usuario_aprueba' => User::whereNotIn('id',[$user->id])->get()->random()->id,
            'usuario_administra' => User::whereNotIn('id',[$user->id])->get()->random()->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (CompraSolicitud $compra){

            $compra->establecerCodigo();
            $compra->save();
        });
    }


}
