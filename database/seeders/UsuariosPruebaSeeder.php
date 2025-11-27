<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Option;
use App\Models\Role;
use App\Models\RrhhUnidad;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        deshabilitaLlavesForaneas();

        $this->requisAlmacen();



    }

    public function requisAlmacen()
    {

        User::whereIn('username', [
            'requirente1',
            'autorizador1',
            'despachador'
        ])->forceDelete();

        $unidadConStock = RrhhUnidad::whereHas('stocks', function ($query) {
            $query->where('cantidad', '>', 0);
        })
            ->where('id',29) // Servicios Generales
            ->first();


        User::factory(1)->create([
            "username" => "requirente1",
            "name" => "Solicitante Requisición Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => $unidadConStock->id,
            'bodega_id' => $unidadConStock->bodega->id,
        ])->each(function (User $user){
            $user->syncRoles(Role::SOLICITANTE_REQUISICION_ALMACEN);

            $opciones =[
                Option::NUEVA_REQUISICION_ALMACEN,
                Option::MIS_REQUISICIONES_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);
        });


        User::factory(1)->create([
            "username" => "autorizador1",
            "name" => "Autorizador Requisiciones Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => $unidadConStock->id,
            'bodega_id' => $unidadConStock->bodega->id,
        ])->each(function (User $user) {
            $user->syncRoles(Role::AUTORIZADOR_REQUISICION_ALMACEN);

            $opciones =[
                Option::AUTORIZAR_REQUISICION_ALMACEN,
                Option::BUSCAR_REQUISICION_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);
        });

        User::factory(1)->create([
            "username" => "despachador",
            "name" => "Despachador Requisiciones Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => RrhhUnidad::ALMACEN,
            'bodega_id' => Bodega::PRINCIPAL,
            'puesto_id' => null,
        ])->each(function (User $user){
            $user->syncRoles(Role::AUTORIZADOR_REQUISICION_ALMACEN);

            $opciones = [
                Option::DESPACHAR_REQUISICION_ALMACEN,
                Option::BUSCAR_REQUISICION_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);

        });

    }


    public function requisCompras()
    {


        $unidadConStock = RrhhUnidad::areas()->solicitan()->whereHas('subProductos')->get();


        $usuarios = [
            'solicitante1' => [
                'name' => 'Solicitante Requisición Compras',
                'role' => Role::SOLICITANTE_REQUISICION_COMPRAS,
                'unidad_id' => $unidadConStock->random()->id,
                'options' => [
                    Option::NUEVA_SOLICITUD_DE_COMPRA,
                    Option::MIS_SOLICITUDES_DE_COMPRAS,
                ],
            ],
            'supervisor1' => [
                'name' => 'Supervisor Requisiciones Compras',
                'role' => Role::SUPERVISOR_COMPRAS,
                'unidad_id' => RrhhUnidad::DEPTO_COMPRAS,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'analista1' => [
                'name' => 'Analista Requisiciones Compras',
                'role' => Role::ANALISTA_COMPRAS,
                'unidad_id' => RrhhUnidad::DEPTO_COMPRAS,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'presupuesto1' => [
                'name' => 'Analista Presupuesto',
                'role' => Role::ANALISTA_PRESUPUESTO,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'aprobador1' => [
                'name' => 'Aprobador Requisiciones Compras',
                'role' => Role::APROBADOR_REQUISICION_COMPRAS,
                'options' => [
                    Option::APROBAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
            'autorizador2' => [
                'name' => 'Autorizador Requisiciones Compras',
                'role' => Role::AUTORIZADOR_REQUISICION_COMPRAS,
                'options' => [
                    Option::AUTORIZAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
        ];

        User::whereIn('username', [
            'solicitante1',
            'aprobador1',
            'autorizador2',
        ])->forceDelete();



    }
}
