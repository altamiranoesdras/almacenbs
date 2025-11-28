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

        $this->requisCompras();

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


        $unidad1 = RrhhUnidad::areas()->solicitan()
            ->whereHas('subProductos')
            ->inRandomOrder()
            ->first();

        $unidad2 = RrhhUnidad::areas()->solicitan()
            ->where('id', '!=', $unidad1->id)
            ->whereHas('subProductos')
            ->inRandomOrder()
            ->first();


        $usuarios = [

            'solicitante_compra1' => [
                'name' => 'Solicitante Requisición Compras',
                'role' => Role::SOLICITANTE_REQUISICION_COMPRAS,
                'unidad_id' => $unidad1->id,
                'bodega_id' => $unidad1->bodega->id,
                'options' => [
                    Option::NUEVA_SOLICITUD_DE_COMPRA,
                    Option::MIS_SOLICITUDES_DE_COMPRAS,
                ],
            ],
            'aprobador_compra1' => [
                'name' => 'Aprobador Requisiciones Compras',
                'role' => Role::APROBADOR_REQUISICION_COMPRAS,
                'unidad_id' => $unidad1->departamentoPadre()->id,
                'options' => [
                    Option::APROBAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
            'autorizador_compra1' => [
                'name' => 'Autorizador Requisiciones Compras',
                'role' => Role::AUTORIZADOR_REQUISICION_COMPRAS,
                'unidad_id' => $unidad1->direccionPadre()->id,
                'options' => [
                    Option::AUTORIZAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
            'solicitante_compra2' => [
                'name' => 'Solicitante Requisición Compras 2',
                'role' => Role::SOLICITANTE_REQUISICION_COMPRAS,
                'unidad_id' => $unidad2->id,
                'bodega_id' => $unidad2->bodega->id,
                'options' => [
                    Option::NUEVA_SOLICITUD_DE_COMPRA,
                    Option::MIS_SOLICITUDES_DE_COMPRAS,
                ],
            ],
            'aprobador_compra2' => [
                'name' => 'Aprobador Requisiciones Compras 2',
                'role' => Role::APROBADOR_REQUISICION_COMPRAS,
                'unidad_id' => $unidad2->departamentoPadre()->id,
                'options' => [
                    Option::APROBAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
            'autorizador_compra2' => [
                'name' => 'Autorizador Requisiciones Compras 2',
                'role' => Role::AUTORIZADOR_REQUISICION_COMPRAS,
                'unidad_id' => $unidad2->direccionPadre()->id,
                'options' => [
                    Option::AUTORIZAR_REQUISICION_COMPRA,
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                ],
            ],
            'supervisor_compra1' => [
                'name' => 'Supervisor Requisiciones Compras',
                'role' => Role::SUPERVISOR_COMPRAS,
                'unidad_id' => RrhhUnidad::DEPTO_COMPRAS,
                'bodega_id' => RrhhUnidad::find(RrhhUnidad::DEPTO_COMPRAS)->bodega->id,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'analista_compra1' => [
                'name' => 'Analista Requisiciones Compras 1',
                'role' => Role::ANALISTA_COMPRAS,
                'unidad_id' => RrhhUnidad::DEPTO_COMPRAS,
                'bodega_id' => RrhhUnidad::find(RrhhUnidad::DEPTO_COMPRAS)->bodega->id,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'analista_compra2' => [
                'name' => 'Analista Requisiciones Compras 2',
                'role' => Role::ANALISTA_COMPRAS,
                'unidad_id' => RrhhUnidad::DEPTO_COMPRAS,
                'bodega_id' => RrhhUnidad::find(RrhhUnidad::DEPTO_COMPRAS)->bodega->id,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],
            'analista_presupuesto1' => [
                'name' => 'Analista Presupuesto',
                'role' => Role::ANALISTA_PRESUPUESTO,
                'unidad_id' => RrhhUnidad::DEPTO_PRESUPUESTOS,
                'bodega_id' => RrhhUnidad::find(RrhhUnidad::DEPTO_PRESUPUESTOS)->bodega->id,
                'options' => [
                    Option::BUSCADOR_REQUISICIONES_COMPRA,
                    Option::APROBAR_REQUISICION_COMPRA,
                ],
            ],

        ];

        // Elimina usuarios de prueba anteriores
        User::whereIn('username', array_keys($usuarios))->forceDelete();

        foreach ($usuarios as $username => $data) {
            User::factory(1)->create([
                'username' => $username,
                'name' => $data['name'],
                'password' => bcrypt('123'),
                'unidad_id' => $data['unidad_id'],
            ])->each(function (User $user) use ($data) {
                $user->syncRoles($data['role']);
                $user->options()->sync($data['options']);
                $user->shortcuts()->sync($data['options']);
            });
        }


    }
}
